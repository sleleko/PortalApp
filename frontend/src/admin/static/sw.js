importScripts('/_nuxt/workbox.4c4f5ca6.js')

workbox.precaching.precacheAndRoute([
  {
    "url": "/_nuxt/app.2f699a9.js",
    "revision": "643adfdc3f5314caacea6fb101bfce4b"
  },
  {
    "url": "/_nuxt/commons/app.87ee19e.js",
    "revision": "a1277bbeb9e06722c1aec7367b3e5038"
  },
  {
    "url": "/_nuxt/pages/admin.6dc780e.js",
    "revision": "494deb05608272bf7748834df46ef93b"
  },
  {
    "url": "/_nuxt/pages/admin/covid.edfff37.js",
    "revision": "d5cb03dcfd596c7f4ea6b254b22741bb"
  },
  {
    "url": "/_nuxt/pages/admin/units.15b1b3b.js",
    "revision": "3be4f7d6aee910f2f32074fed5d8a7b8"
  },
  {
    "url": "/_nuxt/pages/admin/units/create.e3dd43a.js",
    "revision": "d7ae5ade04592757784a5f498bae537c"
  },
  {
    "url": "/_nuxt/pages/admin/units/delete/_id.a492b5e.js",
    "revision": "090b5cd21465fc7a53fc2a5895bcd769"
  },
  {
    "url": "/_nuxt/pages/admin/units/edit/_id.3ebc552.js",
    "revision": "68ce91f83afdb98403c056cf5ad9a1be"
  },
  {
    "url": "/_nuxt/pages/admin/user-roles.354ebe9.js",
    "revision": "03eb1085b3877bd5eee6a5dfb6628929"
  },
  {
    "url": "/_nuxt/pages/admin/user-roles/create.b00332f.js",
    "revision": "afbe3c45aced5e6fab2dc4ec2465959b"
  },
  {
    "url": "/_nuxt/pages/admin/user-roles/delete/_id.efb2f69.js",
    "revision": "ac6b3824eb1be6e83588c1997d8b978e"
  },
  {
    "url": "/_nuxt/pages/admin/user-roles/edit/_id.6feebe3.js",
    "revision": "4b462d407e8181a204fa2cd5bf151d03"
  },
  {
    "url": "/_nuxt/pages/admin/users.d23aca5.js",
    "revision": "e140f9f17a3b491ac59458c278f2475a"
  },
  {
    "url": "/_nuxt/pages/admin/users/create.66c23bb.js",
    "revision": "ecbe3797f72ce7d535c38d819ed30fae"
  },
  {
    "url": "/_nuxt/pages/admin/users/delete/_id.54f8580.js",
    "revision": "59b1295bb795aee460f6686b51d1dd05"
  },
  {
    "url": "/_nuxt/pages/admin/users/edit/_id.77971f3.js",
    "revision": "9201e68c3b4cd6e06059b3a1b058f24c"
  },
  {
    "url": "/_nuxt/pages/index.f904ebf.js",
    "revision": "7cf17bcbf82c23a45eaac620357af757"
  },
  {
    "url": "/_nuxt/pages/user/profile.b24dc7a.js",
    "revision": "6e5ba2164bfa467dbf119a36d24748a9"
  },
  {
    "url": "/_nuxt/runtime.e31cdea.js",
    "revision": "1ae7b4f077edf3b48c6ba2ba41dc482c"
  },
  {
    "url": "/_nuxt/vendors~app.d2b3fb6.js",
    "revision": "f65b134b4b39d55e1263bbb0e9c6b960"
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
