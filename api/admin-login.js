// Vercel Serverless Function — POST /api/admin-login
const CORS_HEADERS = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Methods': 'POST, OPTIONS',
    'Access-Control-Allow-Headers': 'Content-Type',
};

export default async function handler(req, res) {
    Object.entries(CORS_HEADERS).forEach(([k, v]) => res.setHeader(k, v));
    if (req.method === 'OPTIONS') return res.status(200).end();
    if (req.method !== 'POST') return res.status(405).json({ success: false, error: 'Method Not Allowed' });

    try {
        const { username, password } = req.body || {};

        if (!username || !password) {
            return res.status(400).json({ success: false, error: 'Missing credentials' });
        }

        const validUser = process.env.ADMIN_USERNAME;
        const validPass = process.env.ADMIN_PASSWORD;
        const secretToken = process.env.ADMIN_SECRET_TOKEN;

        if (username === validUser && password === validPass) {
            return res.status(200).json({ success: true, token: secretToken });
        } else {
            return res.status(401).json({ success: false, error: 'Invalid credentials' });
        }
    } catch (err) {
        return res.status(500).json({ success: false, error: err.message });
    }
}
