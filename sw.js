const CACHE_NAME = 'fbr-offline-v3';

// Assets to precache for offline display
const PRECACHE_ASSETS = [
    '/',
    '/index.html',
    '/shop.html',
    '/cart.html',
    '/checkout.html',
    '/product.html',
    '/track.html',
    '/success.html',
    '/assets/css/style.css',
    '/assets/css/premium-icons.css',
    '/assets/js/config.js',
    '/assets/js/supabase-init.js',
    '/assets/js/offline-handler.js'
];

const OFFLINE_HTML = `
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You are offline</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0A0A0E 0%, #17111A 100%);
            color: #FAF8F8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 20px;
            margin: 0;
        }
        .offline-glass {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }
        .offline-icon-wrap {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255, 59, 48, 0.1);
            color: #FF3B30;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px auto;
            font-size: 36px;
        }
        h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(to right, #FFFFFF, #B0B0B0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        p { font-size: 15px; color: #8E8E93; line-height: 1.5; margin-bottom: 28px; }
        .btn-retry {
            background: #FFFFFF;
            color: #0A0A0A;
            border: none;
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="offline-glass">
        <div class="offline-icon-wrap">⚠️</div>
        <h1>You are offline</h1>
        <p>This page hasn't been cached yet. Please check your internet connection to continue browsing.</p>
        <button class="btn-retry" onclick="window.location.reload()">Retry Connection</button>
    </div>
</body>
</html>
`;

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(PRECACHE_ASSETS);
        }).then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;

    const requestURL = new URL(event.request.url);

    // Network First, Fallback to Cache for HTML pages and API
    if (event.request.mode === 'navigate' || 
        event.request.headers.get('accept').includes('text/html') || 
        requestURL.href.includes('supabase.co/rest/v1/')) {
        
        event.respondWith(
            fetch(event.request)
                .then((networkResponse) => {
                    const responseClone = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                    return networkResponse;
                })
                .catch(async () => {
                    const cachedResponse = await caches.match(event.request);
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    
                    // If HTML request not in cache, return the custom offline HTML string
                    if (event.request.mode === 'navigate' || event.request.headers.get('accept').includes('text/html')) {
                        return new Response(OFFLINE_HTML, {
                            headers: { 'Content-Type': 'text/html' }
                        });
                    }
                    
                    return new Response('Offline and not in cache', { status: 503, statusText: 'Offline' });
                })
        );
    } 
    // Stale-While-Revalidate for static assets
    else {
        event.respondWith(
            caches.match(event.request).then((cachedResponse) => {
                const fetchPromise = fetch(event.request).then((networkResponse) => {
                    const responseClone = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                    return networkResponse;
                }).catch(() => {
                    // Ignore network errors for static assets
                });
                
                return cachedResponse || fetchPromise;
            })
        );
    }
});
