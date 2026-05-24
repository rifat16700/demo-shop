// ============================================================
// functions/api/master-db.js
// Cloudflare Pages Function — Universal DB Adapter
// Routes all queries to either Supabase or Appwrite
// based on the DB_PROVIDER environment variable.
// ============================================================

import { getConfig } from '../utils/config.js';

// ── JSON fields that are stored as strings in Appwrite ───────
// These are JSONB columns in Supabase → stored as JSON strings in Appwrite
const JSON_FIELDS = [
    'variants', 'gallery_images', 'items', 'addons',
    'messaging_apps', 'product_ids', 'category_ids',
    'districts', 'delivery_zones',
];

// ── Serialize JS object → JSON string for Appwrite inserts ───
function serializeJsonFields(payload) {
    if (!payload || typeof payload !== 'object') return payload;
    const out = { ...payload };
    for (const key of JSON_FIELDS) {
        if (key in out && typeof out[key] !== 'string') {
            out[key] = JSON.stringify(out[key]);
        }
    }
    return out;
}

// ── Parse JSON strings back to objects after reading ─────────
function deserializeJsonFields(row) {
    if (!row || typeof row !== 'object') return row;
    const out = { ...row };
    for (const key of JSON_FIELDS) {
        if (key in out && typeof out[key] === 'string' && out[key].trim().startsWith('[') || 
            key in out && typeof out[key] === 'string' && out[key].trim().startsWith('{')) {
            try { out[key] = JSON.parse(out[key]); } catch (_) {}
        }
    }
    return out;
}

// ─────────────────────────────────────────────────────────────
// MAIN ENTRY POINT
// ─────────────────────────────────────────────────────────────
export async function onRequestPost(context) {
    const config = getConfig(context.env);

    // CORS headers
    const corsHeaders = {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*',
    };

    try {
        const req = await context.request.json();
        const { table, action } = req;

        if (!table || !action) {
            return new Response(
                JSON.stringify({ error: 'Missing table or action' }),
                { status: 400, headers: corsHeaders }
            );
        }

        if (config.DB_PROVIDER === 'appwrite') {
            return await handleAppwrite(config, req, corsHeaders);
        } else {
            return await handleSupabase(config, req, corsHeaders);
        }

    } catch (error) {
        return new Response(
            JSON.stringify({ error: 'MasterDB request failed', details: String(error) }),
            { status: 500, headers: corsHeaders }
        );
    }
}

// ─────────────────────────────────────────────────────────────
// SUPABASE HANDLER
// ─────────────────────────────────────────────────────────────
async function handleSupabase(config, req, corsHeaders) {
    const {
        table, action,
        selectCols, filters, orderObj, limitNum,
        isSingle, payloadData, headFlag, countType, rangeArr,
    } = req;

    let url = `${config.SUPABASE_URL}/rest/v1/${table}`;
    const params = new URLSearchParams();

    // SELECT columns
    if (selectCols && action === 'select') {
        params.append('select', selectCols);
    }

    // FILTERS  — supports: eq, neq, lt, lte, gt, gte, like, in
    if (filters && filters.length > 0) {
        filters.forEach(f => {
            const col = f.args[0];
            const val = f.args[1];
            if (f.method === 'in') {
                // PostgREST in filter: ?col=in.(a,b,c)
                const list = Array.isArray(val) ? val.join(',') : val;
                params.append(col, `in.(${list})`);
            } else {
                params.append(col, `${f.method}.${val}`);
            }
        });
    }

    // ORDER
    if (orderObj) {
        params.append('order', `${orderObj.col}.${orderObj.ascending ? 'asc' : 'desc'}`);
    }

    // LIMIT
    if (limitNum) {
        params.append('limit', limitNum);
    }

    const qs = params.toString();
    if (qs) url += `?${qs}`;

    const headers = {
        'apikey':        config.SUPABASE_ANON_KEY,
        'Authorization': `Bearer ${config.SUPABASE_ANON_KEY}`,
        'Content-Type':  'application/json',
    };

    let method = 'GET';
    let body   = null;
    const prefer = [];

    if (countType)           prefer.push(`count=${countType}`);
    if (isSingle && action === 'select') headers['Accept'] = 'application/vnd.pgrst.object+json';

    if (action === 'insert') {
        method = 'POST';
        body   = JSON.stringify(Array.isArray(payloadData) ? payloadData : [payloadData]);
        prefer.push('return=representation');
    } else if (action === 'update') {
        method = 'PATCH';
        body   = JSON.stringify(payloadData);
        prefer.push('return=representation');
    } else if (action === 'upsert') {
        method = 'POST';
        body   = JSON.stringify(Array.isArray(payloadData) ? payloadData : [payloadData]);
        prefer.push('resolution=merge-duplicates', 'return=representation');
    } else if (action === 'delete') {
        method = 'DELETE';
        prefer.push('return=representation');
    } else if (headFlag) {
        method = 'HEAD';
    }

    if (prefer.length > 0) headers['Prefer'] = prefer.join(',');

    // RANGE (pagination)
    if (rangeArr) {
        headers['Range-Unit'] = 'items';
        headers['Range']      = `${rangeArr[0]}-${rangeArr[1]}`;
    }

    const response = await fetch(url, { method, headers, body });

    let data  = null;
    let error = null;
    let count = null;

    if (!response.ok) {
        error = await response.json().catch(() => ({ message: response.statusText }));
    } else {
        if (method !== 'HEAD' && response.status !== 204) {
            data = await response.json().catch(() => null);
        }
        const contentRange = response.headers.get('content-range');
        if (contentRange) {
            const parts = contentRange.split('/');
            count = parts[1] && parts[1] !== '*' ? parseInt(parts[1], 10) : null;
        }
    }

    return new Response(JSON.stringify({ data, error, count }), {
        status:  200,
        headers: corsHeaders,
    });
}

// ─────────────────────────────────────────────────────────────
// APPWRITE HANDLER
// ─────────────────────────────────────────────────────────────
async function handleAppwrite(config, req, corsHeaders) {
    const {
        table, action,
        selectCols, filters, orderObj, limitNum,
        isSingle, payloadData, headFlag, rangeArr,
    } = req;

    const dbId     = config.APPWRITE_DATABASE_ID;
    const collKey  = `APPWRITE_COLLECTION_${table.toUpperCase()}`;
    const collId   = config[collKey] || table;
    const baseUrl  = `${config.APPWRITE_ENDPOINT}/databases/${dbId}/collections/${collId}/documents`;

    const headers = {
        'X-Appwrite-Project': config.APPWRITE_PROJECT,
        'X-Appwrite-Key':     config.APPWRITE_API_KEY,
        'Content-Type':       'application/json',
    };

    let data  = null;
    let error = null;
    let count = null;

    try {

        // ── SELECT ──────────────────────────────────────────────
        if (action === 'select' || headFlag) {
            const params = new URLSearchParams();

            // Filters
            if (filters && filters.length > 0) {
                filters.forEach(f => {
                    const col = f.args[0] === 'id' ? '$id' : f.args[0];
                    let   val = f.args[1];
                    const isStr = typeof val === 'string';
                    const quoted = isStr ? `"${val}"` : val;

                    switch (f.method) {
                        case 'eq':   params.append('queries[]', `equal("${col}", [${quoted}])`);        break;
                        case 'neq':  params.append('queries[]', `notEqual("${col}", [${quoted}])`);     break;
                        case 'lt':   params.append('queries[]', `lessThan("${col}", [${quoted}])`);     break;
                        case 'lte':  params.append('queries[]', `lessThanEqual("${col}", [${quoted}])`);break;
                        case 'gt':   params.append('queries[]', `greaterThan("${col}", [${quoted}])`);  break;
                        case 'gte':  params.append('queries[]', `greaterThanEqual("${col}", [${quoted}])`); break;
                        case 'like': params.append('queries[]', `search("${col}", "${val}")`);          break;
                        case 'in': {
                            const list = (Array.isArray(val) ? val : [val])
                                .map(v => typeof v === 'string' ? `"${v}"` : v)
                                .join(', ');
                            params.append('queries[]', `equal("${col}", [${list}])`);
                            break;
                        }
                    }
                });
            }

            // Order
            if (orderObj) {
                const dir = orderObj.ascending ? 'orderAsc' : 'orderDesc';
                params.append('queries[]', `${dir}("${orderObj.col}")`);
            }

            // Limit / Range
            if (rangeArr) {
                const limit  = rangeArr[1] - rangeArr[0] + 1;
                const offset = rangeArr[0];
                params.append('queries[]', `limit(${limit})`);
                params.append('queries[]', `offset(${offset})`);
            } else if (limitNum) {
                params.append('queries[]', `limit(${limitNum})`);
            }

            // Select specific columns
            if (selectCols && selectCols !== '*') {
                const cols = selectCols.split(',').map(c => `"${c.trim()}"`).join(', ');
                params.append('queries[]', `select([${cols}])`);
            }

            const fetchUrl = params.toString() ? `${baseUrl}?${params}` : baseUrl;
            const res      = await fetch(fetchUrl, { method: 'GET', headers });

            if (!res.ok) throw await res.json();

            const json = await res.json();
            count = json.total;
            data  = json.documents.map(mapDoc);

            if (isSingle) data = data.length > 0 ? data[0] : null;


        // ── INSERT ──────────────────────────────────────────────
        } else if (action === 'insert') {
            const rows    = Array.isArray(payloadData) ? payloadData : [payloadData];
            const results = [];

            for (const row of rows) {
                const serialized = serializeJsonFields(row);
                const body = JSON.stringify({ documentId: 'unique()', data: serialized });
                const res  = await fetch(baseUrl, { method: 'POST', headers, body });
                if (!res.ok) throw await res.json();
                results.push(mapDoc(await res.json()));
            }

            data = Array.isArray(payloadData) ? results : results[0];


        // ── UPSERT ──────────────────────────────────────────────
        // Appwrite has no native upsert; we try UPDATE then INSERT
        } else if (action === 'upsert') {
            const rows    = Array.isArray(payloadData) ? payloadData : [payloadData];
            const results = [];

            for (const row of rows) {
                const serialized = serializeJsonFields(row);
                // If row has a known id field, try PATCH first
                const docId = row.id || row.$id || null;
                if (docId) {
                    const patchRes = await fetch(`${baseUrl}/${docId}`, {
                        method: 'PATCH',
                        headers,
                        body: JSON.stringify({ data: serialized }),
                    });
                    if (patchRes.ok) {
                        results.push(mapDoc(await patchRes.json()));
                        continue;
                    }
                }
                // Fall back to INSERT
                const body = JSON.stringify({ documentId: docId || 'unique()', data: serialized });
                const res  = await fetch(baseUrl, { method: 'POST', headers, body });
                if (!res.ok) throw await res.json();
                results.push(mapDoc(await res.json()));
            }

            data = Array.isArray(payloadData) ? results : results[0];


        // ── UPDATE ──────────────────────────────────────────────
        } else if (action === 'update') {
            // Find document IDs via filters
            const docIds = await resolveDocIds(baseUrl, headers, filters, config);
            if (!docIds.length) throw new Error('UPDATE: no matching documents found');

            const serialized = serializeJsonFields(payloadData);
            const results = [];

            for (const docId of docIds) {
                const body = JSON.stringify({ data: serialized });
                const res  = await fetch(`${baseUrl}/${docId}`, { method: 'PATCH', headers, body });
                if (!res.ok) throw await res.json();
                results.push(mapDoc(await res.json()));
            }

            data = results;


        // ── DELETE ──────────────────────────────────────────────
        } else if (action === 'delete') {
            const docIds = await resolveDocIds(baseUrl, headers, filters, config);
            if (!docIds.length) { data = []; return; }

            for (const docId of docIds) {
                const res = await fetch(`${baseUrl}/${docId}`, { method: 'DELETE', headers });
                if (!res.ok && res.status !== 404) throw await res.json();
            }

            data = [];
        }

    } catch (err) {
        error = { message: err.message || String(err), details: err };
    }

    return new Response(JSON.stringify({ data, error, count }), {
        status:  200,
        headers: corsHeaders,
    });
}

// ─────────────────────────────────────────────────────────────
// HELPERS
// ─────────────────────────────────────────────────────────────

// Map Appwrite document fields → Supabase-compatible field names
function mapDoc(doc) {
    if (!doc) return doc;
    const out = { ...doc };
    out.id         = doc.$id;
    out.created_at = doc.$createdAt;
    out.updated_at = doc.$updatedAt;
    delete out.$id;
    delete out.$createdAt;
    delete out.$updatedAt;
    delete out.$permissions;
    delete out.$collectionId;
    delete out.$databaseId;
    return deserializeJsonFields(out);
}

// Resolve matching document IDs for UPDATE / DELETE
async function resolveDocIds(baseUrl, headers, filters, config) {
    const eqIdFilter = filters
        ? filters.find(f => f.method === 'eq' && (f.args[0] === 'id' || f.args[0] === '$id'))
        : null;

    if (eqIdFilter) return [eqIdFilter.args[1]];

    // Build query and fetch matching docs
    const params = new URLSearchParams();
    if (filters) {
        filters.forEach(f => {
            const col    = f.args[0] === 'id' ? '$id' : f.args[0];
            const val    = f.args[1];
            const quoted = typeof val === 'string' ? `"${val}"` : val;
            if (f.method === 'eq') params.append('queries[]', `equal("${col}", [${quoted}])`);
        });
    }
    params.append('queries[]', 'limit(100)');

    const url = `${baseUrl}?${params}`;
    const res = await fetch(url, { method: 'GET', headers });
    if (!res.ok) return [];

    const json = await res.json();
    return (json.documents || []).map(d => d.$id);
}
