const CACHE_NAME = 'fbr-offline-v2';
const OFFLINE_URL = '/offline.html';

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
    OFFLINE_URL,
    '/assets/css/style.css',
    '/assets/css/premium-icons.css',
    '/assets/js/config.js',
    '/assets/js/supabase-init.js',
    '/assets/js/offline-handler.js'
];

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
    // We only handle GET requests
    if (event.request.method !== 'GET') return;

    const requestURL = new URL(event.request.url);

    // 1. Network First, Fallback to Cache for HTML pages and Supabase API calls
    if (event.request.mode === 'navigate' || 
        event.request.headers.get('accept').includes('text/html') || 
        requestURL.href.includes('supabase.co/rest/v1/')) {
        
        event.respondWith(
            fetch(event.request)
                .then((networkResponse) => {
                    // Cache the successful response
                    const responseClone = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                    return networkResponse;
                })
                .catch(async () => {
                    // Network failed, try cache
                    const cachedResponse = await caches.match(event.request);
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    
                    // If it's an HTML request and not in cache, show the offline page
                    if (event.request.mode === 'navigate' || event.request.headers.get('accept').includes('text/html')) {
                        return caches.match(OFFLINE_URL);
                    }
                    
                    // Otherwise return a generic 503
                    return new Response('Offline and not in cache', { status: 503, statusText: 'Offline' });
                })
        );
    } 
    // 2. Stale-While-Revalidate for static assets (CSS, JS, Images)
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
                    // Ignore network errors for static assets if we have them in cache
                });
                
                return cachedResponse || fetchPromise;
            })
        );
    }
});
