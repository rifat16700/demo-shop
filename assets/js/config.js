// ============================================================
// config.js — Global Configuration
// Project: Freelancing By Rifat E-Commerce
// ⚠️ FILL IN YOUR SUPABASE CREDENTIALS BELOW
// ============================================================

var CONFIG = {

    // ── Supabase ─────────────────────────────────────────────
    // Supabase Dashboard → Settings → API এ পাবে
    SUPABASE_URL: 'https://qdkppbwjgkkxzgzgsykv.supabase.co',
    SUPABASE_ANON_KEY: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFka3BwYndqZ2treHpnemdzeWt2Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzUyMzY2NjgsImV4cCI6MjA5MDgxMjY2OH0.i1x16UGnM_4C2hVGZS9JreM2FJDxsIYeiHkA4BMOfrk',

    // ── Payment Gateway Proxy ────────────────────────────────
    // mypay.freelancingbyrifat.top — PHP cPanel proxy (active)
    GATEWAY_PROXY_URL: 'https://mypay.freelancingbyrifat.top/api_proxy.php',
    // Gateway API Key — Admin panel settings থেকে override হবে
    GATEWAY_API_KEY: '',

    // ── App Defaults (settings table থেকে override হবে) ─────
    STORE_NAME: 'Freelancing By Rifat',
    CART_KEY: 'fbr_cart',          // localStorage key
    SESSION_KEY: 'fbr_session',

    // ── Admin Panel ───────────────────────────────────────────
    ADMIN_PATH: '/admin',
};
