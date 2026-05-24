// ============================================================
// functions/api/master-db.js
// Cloudflare Pages Function — Universal DB Adapter
// Routes queries to either Supabase or Appwrite
// ============================================================

import { getConfig } from '../utils/config.js';

export async function onRequestPost(context) {
    const config = getConfig(context.env);

    try {
        const req = await context.request.json();
        const { table, action, selectCols, filters, orderObj, limitNum, isSingle, payloadData, headFlag, countType } = req;

        if (!table || !action) {
            return new Response(JSON.stringify({ error: 'Missing table or action' }), { status: 400 });
        }

        if (config.DB_PROVIDER === 'appwrite') {
            return await handleAppwrite(config, req);
        } else {
            return await handleSupabase(config, req);
        }

    } catch (error) {
        return new Response(
            JSON.stringify({ error: 'MasterDB request failed', details: String(error) }),
            { status: 500, headers: { 'Content-Type': 'application/json' } }
        );
    }
}

// ────────────────────────────────────────────────────────────
// SUPABASE HANDLER
// ────────────────────────────────────────────────────────────
async function handleSupabase(config, req) {
    const { table, action, selectCols, filters, orderObj, limitNum, isSingle, payloadData, headFlag, countType } = req;
    
    let url = `${config.SUPABASE_URL}/rest/v1/${table}`;
    const params = new URLSearchParams();
    
    // Select
    if (selectCols && action === 'select') {
        params.append('select', selectCols);
    }
    
    // Filters
    if (filters && filters.length > 0) {
        filters.forEach(f => {
            // e.g., f = { method: 'eq', args: ['id', 1] }
            params.append(f.args[0], `${f.method}.${f.args[1]}`);
        });
    }
    
    // Order
    if (orderObj) {
        // orderObj = { col: 'created_at', ascending: false }
        params.append('order', `${orderObj.col}.${orderObj.ascending ? 'asc' : 'desc'}`);
    }
    
    // Limit
    if (limitNum) {
        params.append('limit', limitNum);
    }
    
    const queryString = params.toString();
    if (queryString) {
        url += `?${queryString}`;
    }

    const headers = {
        'apikey': config.SUPABASE_ANON_KEY,
        'Authorization': `Bearer ${config.SUPABASE_ANON_KEY}`,
        'Content-Type': 'application/json'
    };

    let method = 'GET';
    let body = null;
    let prefer = [];

    if (countType) prefer.push(`count=${countType}`);
    if (isSingle) prefer.push('return=representation'); // Actually single usually expects Accept: application/vnd.pgrst.object+json
    if (isSingle && action === 'select') headers['Accept'] = 'application/vnd.pgrst.object+json';

    if (action === 'insert') {
        method = 'POST';
        body = JSON.stringify(payloadData);
        prefer.push('return=representation');
    } else if (action === 'update') {
        method = 'PATCH';
        body = JSON.stringify(payloadData);
        prefer.push('return=representation');
    } else if (action === 'upsert') {
        method = 'POST';
        body = JSON.stringify(payloadData);
        prefer.push('resolution=merge-duplicates', 'return=representation');
    } else if (action === 'delete') {
        method = 'DELETE';
        prefer.push('return=representation');
    } else if (headFlag) {
        method = 'HEAD';
    }

    if (prefer.length > 0) {
        headers['Prefer'] = prefer.join(',');
    }

    const response = await fetch(url, { method, headers, body });
    
    // Simulate Supabase JS client response format: { data, error, count }
    let data = null;
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
            count = parseInt(contentRange.split('/')[1], 10);
        }
    }

    return new Response(JSON.stringify({ data, error, count }), {
        status: 200,
        headers: { 'Content-Type': 'application/json' }
    });
}

// ────────────────────────────────────────────────────────────
// APPWRITE HANDLER
// ────────────────────────────────────────────────────────────
async function handleAppwrite(config, req) {
    const { table, action, selectCols, filters, orderObj, limitNum, isSingle, payloadData, headFlag, countType } = req;
    
    const dbId = config.APPWRITE_DATABASE_ID;
    const collEnvKey = `APPWRITE_COLLECTION_${table.toUpperCase()}`;
    const collId = config[collEnvKey] || table;
    
    let baseUrl = `${config.APPWRITE_ENDPOINT}/databases/${dbId}/collections/${collId}/documents`;
    const headers = {
        'X-Appwrite-Project': config.APPWRITE_PROJECT,
        'X-Appwrite-Key': config.APPWRITE_API_KEY,
        'Content-Type': 'application/json'
    };

    let data = null;
    let error = null;
    let count = null;

    try {
        if (action === 'select' || headFlag) {
            const params = new URLSearchParams();
            
            if (filters) {
                filters.forEach(f => {
                    const col = f.args[0] === 'id' ? '$id' : f.args[0];
                    let val = f.args[1];
                    // Serialize string value correctly
                    if (typeof val === 'string') val = `"${val}"`;
                    if (f.method === 'eq') params.append('queries[]', `equal("${col}", [${val}])`);
                    if (f.method === 'lt') params.append('queries[]', `lessThan("${col}", [${val}])`);
                    if (f.method === 'gt') params.append('queries[]', `greaterThan("${col}", [${val}])`);
                });
            }
            if (orderObj) {
                const orderMethod = orderObj.ascending ? 'orderAsc' : 'orderDesc';
                params.append('queries[]', `${orderMethod}("${orderObj.col}")`);
            }
            if (limitNum) params.append('queries[]', `limit(${limitNum})`);
            if (selectCols && selectCols !== '*' && selectCols !== 'id') {
                const cols = selectCols.split(',').map(c => `"${c.trim()}"`).join(',');
                params.append('queries[]', `select([${cols}])`);
            }
            
            const qStr = params.toString();
            const fetchUrl = qStr ? `${baseUrl}?${qStr}` : baseUrl;
            
            const res = await fetch(fetchUrl, { method: 'GET', headers });
            if (!res.ok) throw await res.json();
            
            const resJson = await res.json();
            data = resJson.documents.map(mapAppwriteToSupabase);
            count = resJson.total;
            
            if (isSingle) {
                data = data.length > 0 ? data[0] : null;
            }

        } else if (action === 'insert') {
            const payloadArray = Array.isArray(payloadData) ? payloadData : [payloadData];
            const results = [];
            
            for (const item of payloadArray) {
                const body = JSON.stringify({ documentId: 'unique()', data: item });
                const res = await fetch(baseUrl, { method: 'POST', headers, body });
                if (!res.ok) throw await res.json();
                results.push(mapAppwriteToSupabase(await res.json()));
            }
            data = Array.isArray(payloadData) ? results : results[0];

        } else if (action === 'update' || action === 'delete') {
            // Need to find the document ID first via filters
            let docId = null;
            const eqFilter = filters ? filters.find(f => f.method === 'eq' && (f.args[0] === 'id' || f.args[0] === '$id')) : null;
            
            if (eqFilter) docId = eqFilter.args[1];
            else throw new Error("Update/Delete requires an .eq('id', value) filter for Appwrite.");

            const docUrl = `${baseUrl}/${docId}`;
            
            if (action === 'update') {
                const body = JSON.stringify({ data: payloadData });
                const res = await fetch(docUrl, { method: 'PATCH', headers, body });
                if (!res.ok) throw await res.json();
                data = [mapAppwriteToSupabase(await res.json())];
            } else {
                const res = await fetch(docUrl, { method: 'DELETE', headers });
                if (!res.ok) throw await res.json();
                data = []; // Supabase usually returns deleted rows, Appwrite returns empty on 204
            }
        }
    } catch (err) {
        error = { message: err.message || String(err), details: err };
    }

    return new Response(JSON.stringify({ data, error, count }), {
        status: 200,
        headers: { 'Content-Type': 'application/json' }
    });
}

function mapAppwriteToSupabase(doc) {
    if (!doc) return doc;
    const mapped = { ...doc };
    mapped.id = doc.$id;
    mapped.created_at = doc.$createdAt;
    mapped.updated_at = doc.$updatedAt;
    delete mapped.$id;
    delete mapped.$createdAt;
    delete mapped.$updatedAt;
    delete mapped.$permissions;
    delete mapped.$collectionId;
    delete mapped.$databaseId;
    return mapped;
}
