importScripts('/_nuxt/workbox.4c4f5ca6.js')

workbox.precaching.precacheAndRoute([
  {
    "url": "/_nuxt/app.637674c.js",
    "revision": "1a9c338100a0d47b3cb449349cdab172"
  },
  {
    "url": "/_nuxt/commons/app.fccdb3f.js",
    "revision": "67c2f9354b39be8ead409ad6d7a610c8"
  },
  {
    "url": "/_nuxt/pages/gpb-card-form.0b46164.js",
    "revision": "490bccb095d52b0ec59de651d96a7ac0"
  },
  {
    "url": "/_nuxt/pages/gpb.651db66.js",
    "revision": "0f3ee339ac11094adef3e86819947b02"
  },
  {
    "url": "/_nuxt/pages/index.e4a6def.js",
    "revision": "601cdc721f585e1c6da4da85a86a34c8"
  },
  {
    "url": "/_nuxt/runtime.02e78f4.js",
    "revision": "a0c63283c583a825ab6f51f340a79d9f"
  },
  {
    "url": "/_nuxt/vendors~app.705509a.js",
    "revision": "386de639e641ae52255c80d6c518d930"
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
