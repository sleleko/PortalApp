<template>
  <footer class="container mt-auto text-center text-md-right">
    <small>&copy; {{ AppName }} {{ year }}. All rights reserved.</small>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
  data() {
    let year = new Date().getFullYear()
    if (year > 2019) {
      year = '2019 - ' + String(year)
    }
    return {
      AppName: process.env.APP_NAME,
      year,
    }
  },
}
</script>

<style lang="scss">
footer {
  padding: 15px 0;
}
</style>
