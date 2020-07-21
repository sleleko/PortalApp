<template>
  <b-form @submit.prevent="Login">
    <b-form-group id="input-username" label="Username:" label-for="input-username">
      <b-form-input id="input-username" v-model="form.username" :disabled="loading" autofocus required />
    </b-form-group>

    <b-form-group id="input-password" label="Password:" label-for="input-password">
      <b-form-input id="input-password" v-model="form.password" :disabled="loading" required type="password" />
    </b-form-group>

    <b-button type="submit" variant="primary">
      <b-spinner v-if="loading" small />
      Submit
    </b-button>
  </b-form>
</template>

<script>
export default {
  name: 'FormAuth',
  data() {
    return {
      loading: false,
      form: {
        username: null,
        password: null,
      },
    }
  },
  methods: {
    async Login() {
      this.loading = true
      try {
        await this.$auth.loginWith('local', {data: this.form})
        this.loading = false
        this.$notify.success({message: 'Welcome!'})
      } catch (e) {
      } finally {
        this.loading = false
      }
    },
  },
}
</script>
