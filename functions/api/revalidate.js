// ============================================================
// functions/api/revalidate.js
// Cloudflare Pages Function — Supabase Webhook → Cache Purge
//
// Route:   POST /api/revalidate
// Purpose: Receives Supabase table webhook events (INSERT / UPDATE /
//          DELETE on the products table) and purges the affected
//          Cloudflare cache URLs so the storefront always reflects
//          the latest data without a full cache flush.
//
// Security: Caller must supply  Authorization: Bearer rifat123R@16700
// ============================================================

const ZONE_ID     = '0598dcc4092772e88de3339f0b65e327';
const CF_API_TOKEN = 'cfut_8J1aiCc2zW6cOgPqKsfh93baK4SOydqIn1fWEz2q6838b037';

const CF_PURGE_URL = `https://api.cloudflare.com/client/v4/zones/${ZONE_ID}/purge_cache`;

export async function onRequestPost(context) {
    // ── 1. Verify secret token ─────────────────────────────────
    const secret = context.request.headers.get('Authorization');
    if (secret !== 'Bearer rifat123R@16700') {
        return new Response(
            JSON.stringify({ error: 'Unauthorized' }),
            {
                status:  401,
                headers: { 'Content-Type': 'application/json' },
            }
        );
    }

    // ── 2. Parse Supabase webhook body ─────────────────────────
    let body;
    try {
        body = await context.request.json();
    } catch (e) {
        return new Response(
            JSON.stringify({ error: 'Invalid JSON body' }),
            {
                status:  400,
                headers: { 'Content-Type': 'application/json' },
            }
        );
    }

    const record = body.record || body.old_record || {};
    const type   = body.type; // INSERT | UPDATE | DELETE

    // ── 3. Build URLs to purge ─────────────────────────────────
    // Always purge the products list (new/updated/deleted item)
    const listUrl = 'https://store.freelancingbyrifat.top/api/get-products-list';

    // Purge the specific product page only when we have a product ID
    const purgeRequests = [
        fetch(CF_PURGE_URL, {
            method:  'POST',
            headers: {
                'Authorization': `Bearer ${CF_API_TOKEN}`,
                'Content-Type':  'application/json',
            },
            body: JSON.stringify({ files: [listUrl] }),
        }),
    ];

    if (record.id) {
        const urlToPurge = `https://store.freelancingbyrifat.top/api/get-single-product?id=${record.id}`;
        purgeRequests.push(
            fetch(CF_PURGE_URL, {
                method:  'POST',
                headers: {
                    'Authorization': `Bearer ${CF_API_TOKEN}`,
                    'Content-Type':  'application/json',
                },
                body: JSON.stringify({ files: [urlToPurge] }),
            })
        );
    }

    // ── 4. Fire all purge requests in parallel ─────────────────
    await Promise.all(purgeRequests);

    // ── 5. Return success ──────────────────────────────────────
    return new Response(
        JSON.stringify({ success: true, type, id: record.id || null }),
        {
            status:  200,
            headers: { 'Content-Type': 'application/json' },
        }
    );
}
