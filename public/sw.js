const CACHE_NAME = 'marineops-shell-v2';
const SHELL = ['/manifest.webmanifest', '/assets/css/bootstrap.min.css', '/assets/css/fonts.min.css', '/assets/css/marineops.css', '/assets/js/marineops.js', '/assets/img/marineops/marineops-icon.svg'];

self.addEventListener('install', (event) => event.waitUntil(caches.open(CACHE_NAME).then((cache) => cache.addAll(SHELL))));
self.addEventListener('activate', (event) => event.waitUntil(caches.keys().then((keys) => Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))))));
self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET' || event.request.mode === 'navigate') return;
    const url = new URL(event.request.url);
    if (url.origin !== self.location.origin || !url.pathname.startsWith('/assets/')) return;
    event.respondWith(caches.match(event.request).then((cached) => cached || fetch(event.request).then((response) => {
        const copy = response.clone();
        if (response.ok) caches.open(CACHE_NAME).then((cache) => cache.put(event.request, copy));
        return response;
    })));
});
