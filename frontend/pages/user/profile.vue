<template>
  <b-form @submit.prevent="Submit">
    <b-form-group label="Full name">
      <b-form-input v-model="form.fullname" required />
    </b-form-group>

    <b-form-group label="Email">
      <b-form-input v-model="form.email" type="email" />
    </b-form-group>

    <b-form-group label="Phone">
      <b-form-input v-model="form.phone" type="text" />
    </b-form-group>

    <b-form-group label="Password">
      <b-form-input v-model="form.password" type="password" />
    </b-form-group>

    <b-button :disabled="loading" class="mt-2" type="submit" variant="primary">
      <b-spinner v-if="loading" small />
      Update Profile
    </b-button>
  </b-form>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      form: {
        fullname: this.$auth.user.fullname,
        email: this.$auth.user.email,
        phone: this.$auth.user.phone,
        password: null,
      },
    }
  },
  methods: {
    async Submit() {
      this.loading = true
      try {
        const {data: user} = await this.$axios.patch('user/profile', this.form)
        this.$auth.setUser(user.user)

        for (const i in this.form) {
          if (Object.prototype.hasOwnProperty.call(this.form, i)) {
            this.form[i] = user.user[i]
          }
        }

        this.$notify.success({message: 'Success!'})
      } catch (e) {
      } finally {
        this.loading = false
      }
    },
  },
}
</script>
