// ============================================================
// functions/api/_config.js — Cloudflare Pages Functions Config
// ============================================================
//
// ⭐ SINGLE SOURCE OF TRUTH: assets/js/config.js
//
// কেন দুটো ফাইল?
//   → assets/js/config.js  = Browser (var CONFIG = {}) — HTML pages এ use হয়
//   → এই ফাইল              = Cloudflare Edge Runtime (ES Module import)
//     Cloudflare Pages Functions V8 isolate-এ browser globals কাজ করে না,
//     তাই এই separate ES-module রাখতে হয়।
//
// ✅ কিভাবে update করবে?
//   শুধু assets/js/config.js এ SUPABASE_URL / SUPABASE_ANON_KEY বদলাও
//   তারপর নিচের দুটো line এ একই value paste করো — ব্যস।
//
// ── SYNC WITH: assets/js/config.js ───────────────────────────
export const SUPABASE_URL      = 'https://qdkppbwjgkkxzgzgsykv.supabase.co';
export const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFka3BwYndqZ2treHpnemdzeWt2Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzUyMzY2NjgsImV4cCI6MjA5MDgxMjY2OH0.i1x16UGnM_4C2hVGZS9JreM2FJDxsIYeiHkA4BMOfrk';
// ── END SYNC ──────────────────────────────────────────────────
