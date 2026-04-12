// Register Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        // Assume sw.js is in the root directory relative to the host
        navigator.serviceWorker.register('/sw.js').then((registration) => {
            console.log('SW registered with scope:', registration.scope);
        }).catch((err) => {
            console.log('SW registration failed:', err);
        });
    });
}

// Global Online/Offline Event Listeners
window.addEventListener('offline', () => {
    // If the browser registers as offline, route to the offline page.
    // Record current URL so offline page can bounce back to it upon reconnection.
    const currentUrl = window.location.pathname + window.location.search;
    if (currentUrl !== '/offline.html') {
        window.location.href = '/offline.html?redirect=' + encodeURIComponent(currentUrl);
    }
});

// Optional 'Go Offline' manual simulator
function simulateOfflineMode() {
    window.location.href = '/offline.html#simulate';
}
