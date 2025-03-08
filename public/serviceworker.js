var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    "/storage/01JJWPYWNHEGGPC8BJ5DYAT3KF.png",
    "/storage/01JJWPYWNJW0KN430891FVB7H5.png",
    "/storage/01JJWPYWNKYG3M4MDHKHCABMWH.png",
    "/storage/01JJWPYWNNPVYCFQW6W1QHS44D.png",
    "/storage/01JJWPYWNPD8JTFZ300MZJ25V5.png",
    "/storage/01JJWPYWNQJCT6NJ1B7R0WKB75.png",
    "/storage/01JJWPYWNRA52H03FAAD6S66Z7.png",
    "/storage/01JJWPYWNS80FPV6HDB0YSC6AR.png"
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
