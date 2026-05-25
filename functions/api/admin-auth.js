// ============================================================
// functions/api/admin-auth.js
// Cloudflare Pages Function — Universal Admin Authentication
// Supports: Supabase Auth + Appwrite Auth
// All actions: login, logout, session-check
// ============================================================

import { getConfig } from '../utils/config.js';

const CORS = {
    'Content-Type':                'application/json',
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Headers': 'Content-Type',
    'Access-Control-Allow-Methods': 'POST, OPTIONS',
};

// Session cookie name (used for Appwrite token storage)
const SESSION_KEY = 'fbr_admin_session';

export async function onRequest(context) {
    const { request } = context;

    // Handle CORS preflight
    if (request.method === 'OPTIONS') {
        return new Response(null, { status: 204, headers: CORS });
    }

    if (request.method !== 'POST') {
        return new Response(JSON.stringify({ error: 'Method not allowed' }), { status: 405, headers: CORS });
    }

    const config = getConfig(context.env);

    let body;
    try {
        body = await request.json();
    } catch {
        return new Response(JSON.stringify({ error: 'Invalid JSON' }), { status: 400, headers: CORS });
    }

    const { action } = body;

    if (config.DB_PROVIDER === 'appwrite') {
        return await handleAppwriteAuth(config, action, body);
    } else {
        return await handleSupabaseAuth(config, action, body);
    }
}

// ─────────────────────────────────────────────────────────────
// SUPABASE AUTH
// ─────────────────────────────────────────────────────────────
async function handleSupabaseAuth(config, action, body) {
    const base = `${config.SUPABASE_URL}/auth/v1`;
    const headers = {
        'apikey':        config.SUPABASE_ANON_KEY,
        'Authorization': `Bearer ${config.SUPABASE_ANON_KEY}`,
        'Content-Type':  'application/json',
    };

    if (action === 'login') {
        const res = await fetch(`${base}/token?grant_type=password`, {
            method: 'POST',
            headers,
            body: JSON.stringify({ email: body.email, password: body.password }),
        });
        const data = await res.json();
        if (!res.ok) return respond({ error: data.error_description || data.msg || 'Login failed' }, 401);
        return respond({ ok: true, token: data.access_token, user: data.user });
    }

    if (action === 'check') {
        const token = body.token;
        if (!token) return respond({ ok: false });
        const res = await fetch(`${base}/user`, {
            headers: { ...headers, 'Authorization': `Bearer ${token}` },
        });
        if (!res.ok) return respond({ ok: false });
        const user = await res.json();
        return respond({ ok: true, user });
    }

    if (action === 'logout') {
        const token = body.token;
        if (token) {
            await fetch(`${base}/logout`, {
                method: 'POST',
                headers: { ...headers, 'Authorization': `Bearer ${token}` },
            });
        }
        return respond({ ok: true });
    }

    return respond({ error: 'Unknown action' }, 400);
}

// ─────────────────────────────────────────────────────────────
// APPWRITE AUTH
// ─────────────────────────────────────────────────────────────
async function handleAppwriteAuth(config, action, body) {
    const base = `${config.APPWRITE_ENDPOINT}/account`;
    const headers = {
        'X-Appwrite-Project': config.APPWRITE_PROJECT,
        'Content-Type':       'application/json',
    };

    if (action === 'login') {
        // Appwrite email/password session
        const res = await fetch(`${base}/sessions/email`, {
            method: 'POST',
            headers,
            body: JSON.stringify({ email: body.email, password: body.password }),
        });
        const data = await res.json();
        if (!res.ok) return respond({ error: data.message || 'Login failed' }, 401);
        // Return session secret as token
        return respond({
            ok:    true,
            token: data.secret,      // Appwrite session secret
            sessionId: data.$id,     // Session ID (needed for logout)
            user:  { email: body.email },
        });
    }

    if (action === 'check') {
        const token = body.token;
        const sessionId = body.sessionId;
        if (!token) return respond({ ok: false });

        // Verify session is still valid
        const res = await fetch(`${base}/sessions/${sessionId || 'current'}`, {
            headers: { ...headers, 'X-Appwrite-Session': token },
        });
        if (!res.ok) return respond({ ok: false });
        const session = await res.json();
        return respond({ ok: true, user: { email: session.providerUid || '' } });
    }

    if (action === 'logout') {
        const token     = body.token;
        const sessionId = body.sessionId;
        if (token && sessionId) {
            await fetch(`${base}/sessions/${sessionId}`, {
                method:  'DELETE',
                headers: { ...headers, 'X-Appwrite-Session': token },
            });
        }
        return respond({ ok: true });
    }

    return respond({ error: 'Unknown action' }, 400);
}

function respond(data, status = 200) {
    return new Response(JSON.stringify(data), { status, headers: CORS });
}
