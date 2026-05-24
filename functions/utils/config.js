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
        
        // Appwrite Collections
        APPWRITE_COLLECTION_PRODUCTS: env.APPWRITE_COLLECTION_PRODUCTS || 'products',
        APPWRITE_COLLECTION_SETTINGS: env.APPWRITE_COLLECTION_SETTINGS || 'settings',
        APPWRITE_COLLECTION_CATEGORIES: env.APPWRITE_COLLECTION_CATEGORIES || 'categories',
        APPWRITE_COLLECTION_BANNERS: env.APPWRITE_COLLECTION_BANNERS || 'banners',
        APPWRITE_COLLECTION_ORDERS: env.APPWRITE_COLLECTION_ORDERS || 'orders',
        APPWRITE_COLLECTION_ADDONS: env.APPWRITE_COLLECTION_ADDONS || 'addons',
        APPWRITE_COLLECTION_PROMOS: env.APPWRITE_COLLECTION_PROMOS || 'promos',
        APPWRITE_COLLECTION_REVIEWS: env.APPWRITE_COLLECTION_REVIEWS || 'reviews',
        APPWRITE_COLLECTION_HOME_SECTIONS: env.APPWRITE_COLLECTION_HOME_SECTIONS || 'home_sections',
        APPWRITE_COLLECTION_PRODUCT_CATEGORIES: env.APPWRITE_COLLECTION_PRODUCT_CATEGORIES || 'product_categories',
        APPWRITE_COLLECTION_VERIFIED_PAYMENTS: env.APPWRITE_COLLECTION_VERIFIED_PAYMENTS || 'verified_payments',

        // Cloudflare API (for purging cache)
        CF_ZONE_ID: env.CF_ZONE_ID || '',
        CF_API_TOKEN: env.CF_API_TOKEN || '',

        // Webhook Secret (for revalidate.js)
        WEBHOOK_SECRET: env.WEBHOOK_SECRET || ''
    };
}
