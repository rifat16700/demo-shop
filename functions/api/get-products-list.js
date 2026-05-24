// ============================================================
// functions/api/get-products-list.js
// Cloudflare Pages Function — Fetch all products
// Supports Supabase and Appwrite
// ============================================================

import { getConfig } from '../utils/config.js';

export async function onRequest(context) {
    const config = getConfig(context.env);

    try {
        let finalData = [];

        if (config.DB_PROVIDER === 'appwrite') {
            // --- APPWRITE LOGIC ---
            const response = await fetch(
                `${config.APPWRITE_ENDPOINT}/databases/${config.APPWRITE_DATABASE_ID}/collections/${config.APPWRITE_COLLECTION_PRODUCTS}/documents`,
                {
                    headers: {
                        'X-Appwrite-Project': config.APPWRITE_PROJECT,
                        'X-Appwrite-Key': config.APPWRITE_API_KEY,
                        'Content-Type': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                throw new Error(`Appwrite error: ${response.status} ${response.statusText}`);
            }

            const data = await response.json();
            
            // Map Appwrite response to Supabase format
            finalData = data.documents.map(doc => {
                const mapped = { ...doc };
                // Map system fields
                mapped.id = doc.$id;
                mapped.created_at = doc.$createdAt;
                mapped.updated_at = doc.$updatedAt;
                
                // Remove Appwrite system fields to keep it clean (optional but good practice)
                delete mapped.$id;
                delete mapped.$createdAt;
                delete mapped.$updatedAt;
                delete mapped.$permissions;
                delete mapped.$collectionId;
                delete mapped.$databaseId;
                
                return mapped;
            });

        } else {
            // --- SUPABASE LOGIC (Default) ---
            const response = await fetch(
                `${config.SUPABASE_URL}/rest/v1/products?select=*`,
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
            JSON.stringify({ error: 'Failed to fetch products', details: String(error) }),
            {
                status:  500,
                headers: { 'Content-Type': 'application/json' },
            }
        );
    }
}
