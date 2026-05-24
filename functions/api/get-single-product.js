// ============================================================
// functions/api/get-single-product.js
// Cloudflare Pages Function — Fetch one product by ID
// Supports Supabase and Appwrite
// ============================================================

import { getConfig } from '../utils/config.js';

export async function onRequest(context) {
    const config = getConfig(context.env);

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

        let finalData = [];

        if (config.DB_PROVIDER === 'appwrite') {
            // --- APPWRITE LOGIC ---
            const response = await fetch(
                `${config.APPWRITE_ENDPOINT}/databases/${config.APPWRITE_DATABASE_ID}/collections/${config.APPWRITE_COLLECTION_PRODUCTS}/documents/${id}`,
                {
                    headers: {
                        'X-Appwrite-Project': config.APPWRITE_PROJECT,
                        'X-Appwrite-Key': config.APPWRITE_API_KEY,
                        'Content-Type': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                if (response.status === 404) {
                    finalData = []; // Return empty array if not found (matches Supabase behavior)
                } else {
                    throw new Error(`Appwrite error: ${response.status} ${response.statusText}`);
                }
            } else {
                const doc = await response.json();
                
                // Map Appwrite response to Supabase format
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
                
                // Supabase returns an array for .eq() queries
                finalData = [mapped];
            }

        } else {
            // --- SUPABASE LOGIC (Default) ---
            const response = await fetch(
                `${config.SUPABASE_URL}/rest/v1/products?id=eq.${id}&select=*`,
                {
                    headers: {
                        'apikey':        config.SUPABASE_ANON_KEY,
                        'Authorization': `Bearer ${config.SUPABASE_ANON_KEY}`,
                    },
                }
            );

            if (!response.ok) {
                throw new Error(`Supabase error: ${response.status} ${response.statusText}`);
            }

            finalData = await response.json();
        }

        return new Response(JSON.stringify(finalData), {
            status:  200,
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
