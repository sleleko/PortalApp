require("dotenv").config({ path: "../core/.env" });

export default {
  head: {
    title: "Ирбис: Модуль ВКР",
    meta: [
      { charset: "utf-8" },
      {
        name: "viewport",
        content:
          "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
      },
      { hid: "description", name: "description", content: "" }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
  },
  loading: {
    color: "#fff"
  },
  css: [],
  plugins: [
    '../_common/plugins/app.js',
    '../_common/plugins/settings.js',
  ],
  modules: ["@nuxtjs/axios", "@nuxtjs/dotenv"],
  axios: {
    baseURL: process.env.SITE_URL + "api/",
    progress: true,
    proxyHeaders: false,
    credentials: false
  },
  dotenv: {
    path: "../core/",
    filename: ".env"
  },
  router: {
    linkActiveClass: "active"
  }
};
