// ============================================================
// functions/api/get-products-list.js
// Cloudflare Pages Function — Fetch all products from Supabase
//
// Route: GET /api/get-products-list
// Credentials sourced from: ./_config.js  (mirrors assets/js/config.js)
// ============================================================

import { SUPABASE_URL, SUPABASE_ANON_KEY } from './_config.js';

export async function onRequest(context) {
    try {
        const response = await fetch(
            `${SUPABASE_URL}/rest/v1/products?select=*`,
            {
                headers: {
                    'apikey':        SUPABASE_ANON_KEY,
                    'Authorization': `Bearer ${SUPABASE_ANON_KEY}`,
                },
            }
        );

        const data = await response.json();

        return new Response(JSON.stringify(data), {
            status:  response.status,
            headers: {
                'Content-Type':                'application/json',
                'Access-Control-Allow-Origin': '*',
            },
        });
    } catch (error) {
        return new Response(
            JSON.stringify({ error: 'Failed to fetch products', details: String(error) }),
            {
                status:  500,
                headers: { 'Content-Type': 'application/json' },
            }
        );
    }
}
