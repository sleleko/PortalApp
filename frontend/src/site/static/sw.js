importScripts('/_nuxt/workbox.4c4f5ca6.js')

workbox.precaching.precacheAndRoute([
  {
    "url": "/_nuxt/app.ca3c659.js",
    "revision": "cd63ba5cfe41cd161b8d9ca73c0db877"
  },
  {
    "url": "/_nuxt/commons/app.b590830.js",
    "revision": "27fce43fa6890383e9ea40bf0285f130"
  },
  {
    "url": "/_nuxt/pages/gpb-card-form.9369af0.js",
    "revision": "afa6940952008000e5f70bdb886f1c0b"
  },
  {
    "url": "/_nuxt/pages/gpb.988b67b.js",
    "revision": "9e40cae885d2e21822772d158c2c2f4b"
  },
  {
    "url": "/_nuxt/pages/index.fef5f04.js",
    "revision": "87f27b70f4bae3ee60a1bbeefa946fcb"
  },
  {
    "url": "/_nuxt/runtime.e01e90a.js",
    "revision": "7e9e19f98d0260286e973d4c749f711d"
  },
  {
    "url": "/_nuxt/vendors~app.a0f1a4e.js",
    "revision": "6192ddf70b53bb9412ad54df28be19c9"
  }
], {
  "cacheId": "portal",
  "directoryIndex": "/",
  "cleanUrls": false
})

workbox.clientsClaim()
workbox.skipWaiting()

workbox.routing.registerRoute(new RegExp('/_nuxt/.*'), workbox.strategies.cacheFirst({}), 'GET')

workbox.routing.registerRoute(new RegExp('/.*'), workbox.strategies.networkFirst({}), 'GET')
