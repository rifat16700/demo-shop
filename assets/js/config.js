// ============================================================
// assets/js/config.js  —  Local Development Fallback Only
// Project: Freelancing By Rifat E-Commerce
// ============================================================
//
// ⚠️  PRODUCTION-এ এই ফাইল কখনো serve হয় না!
//     Cloudflare Pages Middleware (functions/_middleware.js)
//     এই ফাইলের request intercept করে Cloudflare
//     Environment Variables থেকে CONFIG তৈরি করে দেয়।
//
// ✅  এই ফাইলটা শুধু local development এর জন্য fallback।
//     Cloudflare Dashboard → Settings → Environment Variables
//     এ সব credentials রাখুন।
// ============================================================

var CONFIG = {

    // ── ⚡ DB PROVIDER ────────────────────────────────────────
    // Cloudflare Env Variable: DB_PROVIDER
    // 'supabase' | 'appwrite'
    DB_PROVIDER: 'supabase',

    // ── 🔵 SUPABASE ──────────────────────────────────────────
    // Cloudflare Env Variables: SUPABASE_URL, SUPABASE_ANON_KEY
    SUPABASE_URL:      '',
    SUPABASE_ANON_KEY: '',

    // ── 🟡 APPWRITE ──────────────────────────────────────────
    // Cloudflare Env Variables: APPWRITE_ENDPOINT, APPWRITE_PROJECT, APPWRITE_DATABASE_ID
    APPWRITE_ENDPOINT:    '',
    APPWRITE_PROJECT:     '',
    APPWRITE_DATABASE_ID: '',

    // ── 🟢 Frontend Constants (DB ছাড়াই কাজ করে) ───────────
    CART_KEY:         'fbr_cart',
    DIRECT_ORDER_KEY: 'fbr_direct_order',
    SESSION_KEY:      'fbr_session',
    ADMIN_PATH:       '/admin',

};
