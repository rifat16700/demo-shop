// ============================================================
// functions/utils/config.js
// Helper to extract Cloudflare Pages environment variables
// ============================================================

export function getConfig(env) {
    return {
        // Database Selection (supabase | appwrite)
        DB_PROVIDER: (env.DB_PROVIDER || 'supabase').toLowerCase(),

        // Supabase Settings
        SUPABASE_URL: env.SUPABASE_URL || '',
        SUPABASE_ANON_KEY: env.SUPABASE_ANON_KEY || '',

        // Appwrite Settings
        APPWRITE_ENDPOINT: env.APPWRITE_ENDPOINT || 'https://cloud.appwrite.io/v1',
        APPWRITE_PROJECT: env.APPWRITE_PROJECT || '',
        APPWRITE_API_KEY: env.APPWRITE_API_KEY || '',
        APPWRITE_DATABASE_ID: env.APPWRITE_DATABASE_ID || '',
        APPWRITE_COLLECTION_PRODUCTS: env.APPWRITE_COLLECTION_PRODUCTS || '',

        // Cloudflare API (for purging cache)
        CF_ZONE_ID: env.CF_ZONE_ID || '',
        CF_API_TOKEN: env.CF_API_TOKEN || '',

        // Webhook Secret (for revalidate.js)
        WEBHOOK_SECRET: env.WEBHOOK_SECRET || ''
    };
}
