importScripts('/admin/_nuxt/workbox.4c4f5ca6.js')

workbox.precaching.precacheAndRoute([
  {
    "url": "/admin/_nuxt/app.1197513.js",
    "revision": "625f040fb87c06a253c206ec3e99cf6b"
  },
  {
    "url": "/admin/_nuxt/commons/app.23992c6.js",
    "revision": "db02e1a7adcdfddf4154c845ade8df3e"
  },
  {
    "url": "/admin/_nuxt/pages/admin.6281c49.js",
    "revision": "9a7673a9bb19a39e5c885274b673f7a5"
  },
  {
    "url": "/admin/_nuxt/pages/admin/covid.5f23980.js",
    "revision": "5336c1699cc64f090bd3bd05f160d48a"
  },
  {
    "url": "/admin/_nuxt/pages/admin/units.963ef00.js",
    "revision": "bdc72b256f3ac42dc8c5ecd88d19fba9"
  },
  {
    "url": "/admin/_nuxt/pages/admin/units/create.05fe1dd.js",
    "revision": "be90a1afcf1d1594c9d431d9e445aa48"
  },
  {
    "url": "/admin/_nuxt/pages/admin/units/delete/_id.35330ad.js",
    "revision": "a65c6d9762d468d16adc47278b421308"
  },
  {
    "url": "/admin/_nuxt/pages/admin/units/edit/_id.b6f0423.js",
    "revision": "46d559a2acd65f5ec0637dc8cc2702e6"
  },
  {
    "url": "/admin/_nuxt/pages/admin/user-roles.1dd606a.js",
    "revision": "b1b3f0f7e5900302fb17d29104762981"
  },
  {
    "url": "/admin/_nuxt/pages/admin/user-roles/create.ed93805.js",
    "revision": "feb763d81166fe191201688d4a532b13"
  },
  {
    "url": "/admin/_nuxt/pages/admin/user-roles/delete/_id.7d94447.js",
    "revision": "3b10199ef844ff820abc0fddfc788d40"
  },
  {
    "url": "/admin/_nuxt/pages/admin/user-roles/edit/_id.dd302be.js",
    "revision": "834285fd944ad7a340ea8e82efdaa54a"
  },
  {
    "url": "/admin/_nuxt/pages/admin/users.04f898a.js",
    "revision": "86e84398e139d598d5c47c9cef67eec2"
  },
  {
    "url": "/admin/_nuxt/pages/admin/users/create.27215ba.js",
    "revision": "6e9f734bfa7585b9b9afecd15c2fb3f1"
  },
  {
    "url": "/admin/_nuxt/pages/admin/users/delete/_id.b7966a5.js",
    "revision": "705c8dacde4e579a9b6f9c7bddc5ca26"
  },
  {
    "url": "/admin/_nuxt/pages/admin/users/edit/_id.66d23ef.js",
    "revision": "225e1f2e96630e3495d523c364115847"
  },
  {
    "url": "/admin/_nuxt/pages/index.bce4375.js",
    "revision": "fc23f2273bf9118ec3727cebe41e9485"
  },
  {
    "url": "/admin/_nuxt/pages/user/profile.1c9a39e.js",
    "revision": "77628d73f15b187b73f3ebbec912eed8"
  },
  {
    "url": "/admin/_nuxt/pages/vkr.aa975e5.js",
    "revision": "58b6eb61d4921b0e68d85fb533d51857"
  },
  {
    "url": "/admin/_nuxt/pages/vkr/create.34079c6.js",
    "revision": "bea9dafeaf2308f5191836c3c3bc51a9"
  },
  {
    "url": "/admin/_nuxt/pages/vkr/delete/_id.eef7994.js",
    "revision": "51157ba66cb6b76d7f3eadd309fdcb19"
  },
  {
    "url": "/admin/_nuxt/pages/vkr/edit/_id.a30a77d.js",
    "revision": "2dfadbd82979930afa05c8a8ce353162"
  },
  {
    "url": "/admin/_nuxt/runtime.488e508.js",
    "revision": "cb3bcb66f58c3f02f0d1a80252cd5cc6"
  },
  {
    "url": "/admin/_nuxt/vendors~app.d87d347.js",
    "revision": "60e6f76dd5fde20d39fe6cc6e3bb1145"
  }
], {
  "cacheId": "portal",
  "directoryIndex": "/",
  "cleanUrls": false
})

workbox.clientsClaim()
workbox.skipWaiting()

workbox.routing.registerRoute(new RegExp('/admin/_nuxt/.*'), workbox.strategies.cacheFirst({}), 'GET')

workbox.routing.registerRoute(new RegExp('/admin/.*'), workbox.strategies.networkFirst({}), 'GET')
