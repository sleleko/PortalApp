require('dotenv').config({path: '../core/.env'})

export default {
  srcDir: __dirname,
  mode: 'universal',
  // mode: 'spa',
  head: {
    title: process.env.APP_NAME,
    meta: [
      {charset: 'utf-8'},
      {name: 'viewport', content: 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'},
      {name: 'apple-mobile-web-app-title', content: process.env.APP_NAME},
      {hid: 'title', name: 'title', content: process.env.APP_NAME},
    ],
  },
  css: ['~assets/scss/styles.scss'],
  // css: [],
  buildDir: '.nuxt/site',
  plugins: ['../_common/plugins/fontawesome.js', '../_common/plugins/filepond.js'],
  modules: ['bootstrap-vue/nuxt', 'nuxt-izitoast', '@nuxtjs/axios', '@nuxtjs/pwa', '@nuxtjs/dotenv'],
  loading: {
    color: '#fff',
  },
  bootstrapVue: {
    css: false,
    bvCSS: false,
  },
  dotenv: {
    path: '../core/',
    filename: '.env',
    only: ['APP_NAME', 'SITE_URL'],
  },
  axios: {
    // baseURL: process.env.SITE_URL + 'api/',
    baseURL: 'https://campus.tyumsmu.ru/api/',
    progress: true,
    proxyHeaders: false,
    credentials: false,
  },
  router: {
    linkActiveClass: 'active',
  },
  izitoast: {
    position: 'bottomRight',
    transitionIn: 'bounceInLeft',
    transitionOut: 'fadeOutRight',
  },
  generate: {
    dir: 'dist/site',
  },
  server: {
    host: '127.0.0.1',
    port: 5875,
  },
}
