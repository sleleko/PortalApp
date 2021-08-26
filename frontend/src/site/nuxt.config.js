// export default {
//   head: {
//     title: process.env.APP_NAME,
//     meta: [
//       {charset: 'utf-8'},
//       {name: 'viewport', content: 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'},
//       {name: 'apple-mobile-web-app-title', content: process.env.APP_NAME},
//       {hid: 'title', name: 'title', content: process.env.APP_NAME},
//     ],
//   },
//   css: ['~assets/scss/styles.scss'],
//   // css: [],
//   buildDir: '.nuxt/site',
//   plugins: [
//     '../_common/plugins/app.js',
//     '../_common/plugins/settings.js',
//     '../_common/plugins/fontawesome.js',
//     '../_common/plugins/filepond.js',
//   ],
//   modules: ['bootstrap-vue/nuxt', 'nuxt-izitoast', '@nuxtjs/axios', '@nuxtjs/pwa', '@nuxtjs/dotenv'],
//   loading: {
//     color: '#fff',
//   },
//   bootstrapVue: {
//     css: false,
//     bvCSS: false,
//   },
//   dotenv: {
//     path: '../core/',
//     filename: '.env',
//     only: ['APP_NAME', 'SITE_URL'],
//   },
//   axios: {
//     // baseURL: process.env.SITE_URL + 'api/',
//     baseURL: 'https://vkr-irbis.tyumsmu.ru/api/',
//     progress: true,
//     proxyHeaders: false,
//     credentials: false,
//   },
//   router: {
//     linkActiveClass: 'active',
//   },
//   izitoast: {
//     position: 'bottomRight',
//     transitionIn: 'bounceInLeft',
//     transitionOut: 'fadeOutRight',
//   },
//   generate: {
//     dir: 'dist/site',
//   },
//   server: {
//     host: '127.0.0.1',
//     port: 5875,
//   },
// }

import Config from '../../nuxt.config'

Config.srcDir = __dirname
Config.buildDir = '.nuxt/site'
Config.generate = {
  dir: 'dist/site',
}
Config.mode = 'universal'
Config.plugins.push('../_common/plugins/fontawesome.js')
Config.plugins.push('../_common/plugins/filepond.js')
Config.modules.push('bootstrap-vue/nuxt')
Config.modules.push('nuxt-izitoast')
Config.modules.push('@nuxtjs/axios')
Config.modules.push('@nuxtjs/pwa')
Config.modules.push('@nuxtjs/dotenv')
Config.css.push('~assets/scss/styles.scss')
Config.axios = {
  baseURL: process.env.SITE_URL + 'api/',
  progress: true,
  proxyHeaders: false,
  credentials: false,
}

// require('dotenv').config({path: '../core/.env'})
// Config.server =
//   process.env.NODE_ENV === 'production'
//     ? {socket: '../tmp/nuxt.socket', timing: {total: true}}
//     : {host: '0.0.0.0', port: 4100}

export default Config
