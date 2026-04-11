// ============================================================
// supabase-init.js — Supabase Client Initialization
// Include AFTER config.js on every page
// ============================================================

// Initialize Supabase client — global window.sb
var sb = supabase.createClient(CONFIG.SUPABASE_URL, CONFIG.SUPABASE_ANON_KEY);

// Quick sanity check
if (!CONFIG.SUPABASE_URL || CONFIG.SUPABASE_URL.includes('YOUR_PROJECT')) {
    console.warn('⚠️  Supabase credentials not set in config.js!');
}
