/**
 * Vercel Serverless Function — Cloudflare D1 Universal API Router
 * Route: /api/cf/[table]
 *
 * Handles all CRUD operations for any D1 table.
 * DB_PROVIDER === 'cf_db' হলে এই API ব্যবহার হবে।
 *
 * Query params:
 *   GET    /api/cf/orders              → SELECT * FROM orders ORDER BY created_at DESC
 *   GET    /api/cf/orders?id=xxx       → SELECT * FROM orders WHERE id = 'xxx'
 *   POST   /api/cf/orders              → INSERT INTO orders ...
 *   PATCH  /api/cf/orders?id=xxx       → UPDATE orders SET ... WHERE id = 'xxx'
 *   DELETE /api/cf/orders?id=xxx       → DELETE FROM orders WHERE id = 'xxx'
 *
 * Special query params for GET:
 *   ?filter[column]=value              → WHERE column = 'value'
 *   ?order=column                      → ORDER BY column DESC
 *   ?limit=100                         → LIMIT 100
 *   ?select=col1,col2                  → SELECT col1, col2
 */

const CF_ACCOUNT_ID  = process.env.CF_ACCOUNT_ID;
const CF_DATABASE_ID = process.env.CF_D1_DATABASE_ID;
const CF_API_TOKEN   = process.env.CF_API_TOKEN;
const ADMIN_SECRET   = process.env.ADMIN_SECRET || '';

// Tables that are allowed (whitelist for security)
const ALLOWED_TABLES = [
    'orders', 'products', 'settings', 'reviews', 'promos',
    'delivery_zones', 'banners', 'addons', 'categories',
    'home_sections', 'verified_payments', 'devtools', 'admins',
    'product_categories'
];

// Columns that need JSON parsing when reading
const JSON_COLUMNS = {
    orders:         ['items', 'addons'],
    products:       ['gallery_images', 'variants'],
    settings:       ['telegram_main_chats', 'messaging_apps', 'crypto_coins'],
    reviews:        ['images'],
    promos:         ['applicable_products', 'applicable_categories', 'applicable_districts', 'applicable_payments'],
    addons:         ['fields'],
    delivery_zones: ['districts'],
    home_sections:  ['product_ids'],
    banners:        [],
    categories:     [],
};

// D1 REST API base URL
function d1Url(path = '') {
    return `https://api.cloudflare.com/client/v4/accounts/${CF_ACCOUNT_ID}/d1/database/${CF_DATABASE_ID}${path}`;
}

// Execute SQL on Cloudflare D1 via REST API
async function d1Query(sql, params = []) {
    const res = await fetch(d1Url('/query'), {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${CF_API_TOKEN}`,
            'Content-Type':  'application/json',
        },
        body: JSON.stringify({ sql, params }),
    });
    const json = await res.json();
    if (!json.success) {
        const errMsg = json.errors?.[0]?.message || 'D1 query failed';
        throw new Error(errMsg);
    }
    return json.result?.[0] || { results: [], meta: {} };
}

// Parse JSON columns in rows
function parseJsonCols(rows, table) {
    const cols = JSON_COLUMNS[table] || [];
    if (!cols.length) return rows;
    return rows.map(row => {
        cols.forEach(col => {
            if (row[col] && typeof row[col] === 'string') {
                try { row[col] = JSON.parse(row[col]); } catch { /* keep as string */ }
            }
        });
        return row;
    });
}

// CORS headers
const CORS = {
    'Access-Control-Allow-Origin':  '*',
    'Access-Control-Allow-Methods': 'GET, POST, PATCH, DELETE, OPTIONS',
    'Access-Control-Allow-Headers': 'Content-Type, x-admin-secret',
};

function json(data, status = 200) {
    return new Response(JSON.stringify(data), {
        status,
        headers: { ...CORS, 'Content-Type': 'application/json' },
    });
}

// Admin-only tables that require ADMIN_SECRET header
const ADMIN_ONLY = ['admins', 'devtools'];

export default async function handler(req) {
    // Handle CORS preflight
    if (req.method === 'OPTIONS') {
        return new Response(null, { status: 204, headers: CORS });
    }

    // Validate env vars
    if (!CF_ACCOUNT_ID || !CF_DATABASE_ID || !CF_API_TOKEN) {
        return json({ success: false, error: 'Server misconfiguration: CF env vars missing' }, 500);
    }

    // Extract table from URL: /api/cf/[table]
    const url     = new URL(req.url);
    const parts   = url.pathname.split('/').filter(Boolean);
    // parts = ['api', 'cf', 'tableName']
    const table   = parts[2];

    if (!table || !ALLOWED_TABLES.includes(table)) {
        return json({ success: false, error: `Table '${table}' not allowed` }, 400);
    }

    // Check admin secret for write operations on sensitive tables
    const adminSecret = req.headers.get('x-admin-secret') || '';
    if (ADMIN_ONLY.includes(table) && adminSecret !== ADMIN_SECRET) {
        return json({ success: false, error: 'Unauthorized' }, 401);
    }

    const id     = url.searchParams.get('id');
    const limit  = parseInt(url.searchParams.get('limit') || '5000', 10);
    const order  = url.searchParams.get('order') || 'created_at';
    const select = url.searchParams.get('select') || '*';

    // Build WHERE from filter[col]=val params
    const filterClauses = [];
    const filterParams  = [];
    for (const [key, val] of url.searchParams.entries()) {
        const m = key.match(/^filter\[(.+)\]$/);
        if (m) {
            filterClauses.push(`${m[1]} = ?`);
            filterParams.push(val);
        }
    }

    try {
        // ── GET ────────────────────────────────────────────────────
        if (req.method === 'GET') {
            if (id) {
                // Single row by ID
                const r = await d1Query(`SELECT ${select} FROM ${table} WHERE id = ?`, [id]);
                const rows = parseJsonCols(r.results || [], table);
                if (!rows.length) return json({ success: false, error: 'Not found' }, 404);
                return json({ success: true, data: rows[0] });
            }

            // List rows
            let sql = `SELECT ${select} FROM ${table}`;
            if (filterClauses.length) sql += ` WHERE ${filterClauses.join(' AND ')}`;
            sql += ` ORDER BY ${order} DESC LIMIT ${limit}`;

            const r    = await d1Query(sql, filterParams);
            const rows = parseJsonCols(r.results || [], table);
            return json({ success: true, data: rows, count: rows.length });
        }

        // ── POST (INSERT) ──────────────────────────────────────────
        if (req.method === 'POST') {
            const body = await req.json();

            // Generate ID if not provided
            if (!body.id) {
                body.id = crypto.randomUUID();
            }

            // JSON-stringify any object/array fields
            const jsonCols = JSON_COLUMNS[table] || [];
            jsonCols.forEach(col => {
                if (body[col] && typeof body[col] === 'object') {
                    body[col] = JSON.stringify(body[col]);
                }
            });

            // Build INSERT
            const cols   = Object.keys(body);
            const vals   = Object.values(body);
            const placeholders = cols.map(() => '?').join(', ');
            const sql = `INSERT INTO ${table} (${cols.join(', ')}) VALUES (${placeholders})`;

            await d1Query(sql, vals);
            return json({ success: true, id: body.id });
        }

        // ── PATCH (UPDATE) ─────────────────────────────────────────
        if (req.method === 'PATCH') {
            if (!id) return json({ success: false, error: 'id required for PATCH' }, 400);

            const body = await req.json();

            // JSON-stringify any object/array fields
            const jsonCols = JSON_COLUMNS[table] || [];
            jsonCols.forEach(col => {
                if (body[col] && typeof body[col] === 'object') {
                    body[col] = JSON.stringify(body[col]);
                }
            });

            const setClauses = Object.keys(body).map(k => `${k} = ?`).join(', ');
            const vals       = [...Object.values(body), id];
            const sql = `UPDATE ${table} SET ${setClauses} WHERE id = ?`;

            await d1Query(sql, vals);
            return json({ success: true });
        }

        // ── DELETE ─────────────────────────────────────────────────
        if (req.method === 'DELETE') {
            if (!id) return json({ success: false, error: 'id required for DELETE' }, 400);
            await d1Query(`DELETE FROM ${table} WHERE id = ?`, [id]);
            return json({ success: true });
        }

        return json({ success: false, error: 'Method not allowed' }, 405);

    } catch (err) {
        console.error('[cf-api]', err);
        return json({ success: false, error: err.message }, 500);
    }
}

export const config = {
    runtime: 'edge',  // Vercel Edge Runtime (faster, global)
};
