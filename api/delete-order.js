// Vercel Serverless Function — POST /api/delete-order
const CORS_HEADERS = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Methods': 'POST, OPTIONS',
    'Access-Control-Allow-Headers': 'Content-Type, Authorization',
};

export default async function handler(req, res) {
    Object.entries(CORS_HEADERS).forEach(([k, v]) => res.setHeader(k, v));
    if (req.method === 'OPTIONS') return res.status(200).end();
    if (req.method !== 'POST') return res.status(405).json({ success: false, error: 'Method Not Allowed' });

    // Admin Security Check
    const authHeader = req.headers.authorization || '';
    if (!authHeader.startsWith('Bearer ') || authHeader.split(' ')[1] !== process.env.ADMIN_SECRET_TOKEN) {
        return res.status(401).json({ success: false, error: 'Unauthorized' });
    }

    try {
        const { id, cleanupOld, dateBefore } = req.body;
        
        let sql = "";
        let params = [];
        
        if (cleanupOld && dateBefore) {
            sql = "DELETE FROM orders WHERE (status = 'Delivered' OR status = 'Cancelled') AND created_at < ?";
            params = [dateBefore];
        } else if (id) {
            sql = "DELETE FROM orders WHERE id = ?";
            params = [id];
        } else {
            throw new Error("No id or cleanup condition provided");
        }

        const d1Res = await fetch(
            `https://api.cloudflare.com/client/v4/accounts/${process.env.CF_ACCOUNT_ID}/d1/database/${process.env.CF_DB_ID}/query`,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${process.env.CF_WRITE_TOKEN}`
                },
                body: JSON.stringify({ sql, params })
            }
        );

        const data = await d1Res.json();
        if (!data.success) throw new Error(data.errors?.[0]?.message || 'D1 Error');

        return res.status(200).json({ success: true });
    } catch (err) {
        return res.status(500).json({ success: false, error: err.message });
    }
}
