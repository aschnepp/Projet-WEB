importScripts(
  "https://storage.googleapis.com/workbox-cdn/releases/6.2.0/workbox-sw.js"
);

workbox.precaching.precacheAndRoute([
  // Add the URLs of the pages you want to cache here
  // For example:
  { url: "../index.php", revision: "1" },
  { url: "../pages/403.php", revision: "1" },
  { url: "../pages/404.php", revision: "1" },
  { url: "../pages/about.php", revision: "1" },
  { url: "../pages/cgu.php", revision: "1" },
  { url: "../pages/contact.php", revision: "1" },
  { url: "../pages/gestion-entreprise.php", revision: "1" },
  { url: "../pages/gestion-etudiant.php", revision: "1" },
  { url: "../pages/gestion-offre.php", revision: "1" },
  { url: "../pages/gestion-tuteur.php", revision: "1" },
  { url: "../pages/login.php", revision: "1" },
  { url: "../pages/postuler.php", revision: "1" },
  { url: "../pages/presentation-entreprise.php", revision: "1" },
  { url: "../pages/profil.php", revision: "1" },
  { url: "../pages/review-entreprise.php", revision: "1" },
  { url: "../pages/search.php", revision: "1" },
  { url: "../pages/stats-entreprise.php", revision: "1" },
  { url: "../pages/stats-offres.php", revision: "1" },
  { url: "../pages/stats-offres.php", revision: "1" },
  { url: "../pages/statut-offres.php", revision: "1" },
  { url: "../pages/wishlist.php", revision: "1" },
  // Add more URLs as needed
]);

// Cache CSS files
workbox.routing.registerRoute(
  ({ request }) => request.destination === "style",
  new workbox.strategies.CacheFirst()
);

// Cache JS files
workbox.routing.registerRoute(
  ({ request }) => request.destination === "script",
  new workbox.strategies.CacheFirst()
);

// Cache Images
workbox.routing.registerRoute(
  ({ request }) => request.destination === "image",
  new workbox.strategies.CacheFirst()
);

// Cache Google Fonts
workbox.routing.registerRoute(
  ({ url }) => url.origin === "https://fonts.googleapis.com",
  new workbox.strategies.CacheFirst({
    cacheName: "google-fonts",
    plugins: [
      new workbox.cacheableResponse.CacheableResponsePlugin({
        statuses: [0, 200],
      }),
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 20,
        maxAgeSeconds: 60 * 60 * 24 * 30, // 30 days
      }),
    ],
  })
);
