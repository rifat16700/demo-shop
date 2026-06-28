// Vercel Serverless Function — POST /api/d1-query (Public Read Proxy)
const CORS_HEADERS = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Methods': 'POST, OPTIONS',
    'Access-Control-Allow-Headers': 'Content-Type, Authorization',
};

export default async function handler(req, res) {
    Object.entries(CORS_HEADERS).forEach(([k, v]) => res.setHeader(k, v));
    if (req.method === 'OPTIONS') return res.status(200).end();
    if (req.method !== 'POST') return res.status(405).json({ success: false, error: 'Method Not Allowed' });

    try {
        const { sql, params } = req.body;
        if (!sql) throw new Error("No sql provided");

        const authHeader = req.headers.authorization;
        
        const d1Res = await fetch(
            `https://api.cloudflare.com/client/v4/accounts/${process.env.CF_ACCOUNT_ID}/d1/database/${process.env.CF_DB_ID}/query`,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': authHeader || `Bearer ${process.env.CF_D1_READ_TOKEN}`
                },
                body: JSON.stringify({ sql, params: params || [] })
            }
        );

        const data = await d1Res.json();
        return res.status(d1Res.status).json(data);
    } catch (err) {
        return res.status(500).json({ success: false, error: err.message });
    }
}
