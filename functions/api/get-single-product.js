// ============================================================
// functions/api/get-single-product.js
// Cloudflare Pages Function — Fetch one product from Supabase by ID
//
// Route: GET /api/get-single-product?id=<uuid>
// Credentials sourced from: ./_config.js  (mirrors assets/js/config.js)
// ============================================================

import { SUPABASE_URL, SUPABASE_ANON_KEY } from './_config.js';

export async function onRequest(context) {
    try {
        const { searchParams } = new URL(context.request.url);
        const id = searchParams.get('id');

        if (!id) {
            return new Response(
                JSON.stringify({ error: 'Missing required query parameter: id' }),
                {
                    status:  400,
                    headers: { 'Content-Type': 'application/json' },
                }
            );
        }

        const response = await fetch(
            `${SUPABASE_URL}/rest/v1/products?id=eq.${id}&select=*`,
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
            JSON.stringify({ error: 'Failed to fetch product', details: String(error) }),
            {
                status:  500,
                headers: { 'Content-Type': 'application/json' },
            }
        );
    }
}
