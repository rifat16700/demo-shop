// ============================================================
// config.js — Bootstrap Configuration
// Project: Freelancing By Rifat E-Commerce
// ============================================================
//
// ✅ এই ফাইলে শুধু সেই values আছে যেগুলো Supabase connect করার
//    আগেই দরকার — বাকি সব Admin Panel → settings table থেকে আসে।
//
// ── কী এখানে আছে? ───────────────────────────────────────────
//   🔵 SUPABASE_URL + SUPABASE_ANON_KEY
//      → ছাড়া settings table ই read করা যাবে না
//
//   🟢 CART_KEY / DIRECT_ORDER_KEY / SESSION_KEY
//      → Pure frontend localStorage keys, DB তে নেই
//
//   🟢 ADMIN_PATH
//      → Pure frontend routing constant
//
// ── বাকি সব Admin Panel থেকে আসে ───────────────────────────
//   GATEWAY_PROXY_URL  → settings.gateway_proxy_url
//   GATEWAY_API_KEY    → settings.gateway_api_key
//   BINANCE_PROXY_URL  → settings.binance_proxy_url
//   STORE_NAME         → settings.store_name
//   IMGBB_API_KEY      → settings.imgbb_api_key
// ============================================================

var CONFIG = {

    // ── 🔵 SUPABASE — এই দুটোই শুধু এখানে থাকে ──────────────
    // Supabase Dashboard → Project Settings → API
    SUPABASE_URL:      'https://qdkppbwjgkkxzgzgsykv.supabase.co',
    SUPABASE_ANON_KEY: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFka3BwYndqZ2treHpnemdzeWt2Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzUyMzY2NjgsImV4cCI6MjA5MDgxMjY2OH0.i1x16UGnM_4C2hVGZS9JreM2FJDxsIYeiHkA4BMOfrk',

    // ── 🟢 Frontend Constants — DB ছাড়াই কাজ করে ─────────────
    CART_KEY:         'fbr_cart',
    DIRECT_ORDER_KEY: 'fbr_direct_order',
    SESSION_KEY:      'fbr_session',
    ADMIN_PATH:       '/admin',

};
