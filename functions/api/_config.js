// ============================================================
// functions/api/_config.js — Cloudflare Pages Functions Config
// Mirrors values from: ../../assets/js/config.js
//
// NOTE: assets/js/config.js uses a browser-global var (var CONFIG = {})
// which cannot be directly imported in a Cloudflare Pages Function
// (ES module / V8 isolate runtime). This file re-exports the same
// credentials so both function files share a single source of truth.
// ============================================================

export const SUPABASE_URL     = 'https://qdkppbwjgkkxzgzgsykv.supabase.co';
export const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFka3BwYndqZ2treHpnemdzeWt2Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzUyMzY2NjgsImV4cCI6MjA5MDgxMjY2OH0.i1x16UGnM_4C2hVGZS9JreM2FJDxsIYeiHkA4BMOfrk';
