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
const fbrOfflineOverlay = `
  <div id="fbr-offline-overlay" style="position:fixed;top:0;left:0;width:100vw;height:100vh;background:linear-gradient(135deg, #0A0A0E 0%, #17111A 100%);z-index:999999;display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center;color:#FAF8F8;font-family:'Inter', sans-serif;">
     <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 24px; padding: 40px; max-width: 420px; width: 90%; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);">
        <div id="fbr-offline-icon-wrap" style="width: 80px; height: 80px; border-radius: 50%; background: rgba(255, 59, 48, 0.1); color: #FF3B30; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto; font-size: 36px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi-off"><line x1="2" x2="22" y1="2" y2="22"/><path d="M8.5 16.5a5 5 0 0 1 7 0"/><path d="M2 8.82a15 15 0 0 1 4.17-2.65"/><path d="M10.66 5c4.01-.36 8.14.9 11.34 3.76"/><path d="M16.85 11.25a10 10 0 0 1 2.22 1.68"/><path d="M5 13a10 10 0 0 1 5.24-2.76"/><line x1="12" x2="12.01" y1="20" y2="20"/></svg>
        </div>
        <h1 style="margin:0 0 12px 0; font-size: 24px; font-weight: 800; background: linear-gradient(to right, #FFFFFF, #B0B0B0); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Connection Lost</h1>
        <p id="fbr-offline-status" style="margin:0 0 28px 0;font-size: 15px; color: #8E8E93; line-height: 1.5;">It looks like you are offline. Please check your internet connection. We will automatically resume when you're back online.</p>
        <button onclick="window.location.reload()" style="background: #FFFFFF; color: #0A0A0A; border: none; padding: 14px 28px; font-size: 15px; font-weight: 700; border-radius: 12px; cursor: pointer; width: 100%;">Retry Connection</button>
     </div>
  </div>`;

window.addEventListener('offline', () => {
    // Show overlay instantly without redirecting
    if (!document.getElementById('fbr-offline-overlay')) {
        document.body.insertAdjacentHTML('beforeend', fbrOfflineOverlay);
    }
});

window.addEventListener('online', () => {
    const overlay = document.getElementById('fbr-offline-overlay');
    if (overlay) {
        document.getElementById('fbr-offline-status').innerHTML = '<span style="color:#34C759;font-weight:600;">Connection restored! Resuming...</span>';
        const iconWrap = document.getElementById('fbr-offline-icon-wrap');
        iconWrap.style.background = 'rgba(52, 199, 89, 0.1)';
        iconWrap.style.color = '#34C759';
        iconWrap.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wifi"><path d="M5 13a10 10 0 0 1 14 0"/><path d="M8.5 16.5a5 5 0 0 1 7 0"/><path d="M2 8.82a15 15 0 0 1 20 0"/><line x1="12" x2="12.01" y1="20" y2="20"/></svg>';
        
        // Remove overlay after 1.5s
        setTimeout(() => overlay.remove(), 1500);
    }
});

// Optional 'Go Offline' manual simulator
function simulateOfflineMode() {
    if (!document.getElementById('fbr-offline-overlay')) {
        document.body.insertAdjacentHTML('beforeend', fbrOfflineOverlay);
    }
}
