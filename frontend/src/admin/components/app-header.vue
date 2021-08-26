<template>
  <div>
    <b-navbar toggleable="md" type="dark" variant="dark">
      <b-container>
        <b-navbar-brand :to="{name: 'index'}">
          {{ AppName }}
        </b-navbar-brand>

        <b-navbar-nav class="ml-md-auto order-md-last">
          <b-nav-item v-if="!$auth.loggedIn" @click.prevent="showModal">
            Вход
            <fa :icon="['fas', 'sign-in-alt']" />
          </b-nav-item>
          <b-dropdown v-else id="user-links" :text="$auth.user.fullname" right variant="dark">
            <b-dropdown-item :to="{name: 'user-profile'}">
              Настройки
            </b-dropdown-item>
            <b-dropdown-divider />
            <b-dropdown-item class="logout" @click.prevent="Logout">
              Выход
              <fa :icon="['fas', 'sign-out-alt']" class="ml-auto" size="1x" />
            </b-dropdown-item>
          </b-dropdown>
        </b-navbar-nav>

        <b-navbar-toggle target="nav-collapse" />

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item v-if="$auth.hasScope('users') || $auth.hasScope('users/get')" :to="{name: 'admin'}"
              >Администрирование
            </b-nav-item>
          </b-navbar-nav>
        </b-collapse>
      </b-container>
    </b-navbar>

    <b-modal :visible="isModal && !$auth.loggedIn" hide-footer title="Вход в админ панель" @hidden="hideModal">
      <form-auth />
    </b-modal>
  </div>
</template>

<script>
import {faSignInAlt, faSignOutAlt} from '@fortawesome/free-solid-svg-icons'
import FormAuth from './form-auth'

export default {
  name: 'TyumsmuAPP',
  components: {FormAuth},
  data() {
    return {
      isModal: false,
      AppName: process.env.APP_NAME,
    }
  },
  created() {
    this.$fa.add(faSignInAlt, faSignOutAlt)
  },
  methods: {
    showModal() {
      this.isModal = true
    },
    hideModal() {
      this.isModal = false
    },
    Logout() {
      this.$auth.logout('local').then(() => {
        this.$notify.info({message: 'Досвидания!'})
      })
    },
  },
}
</script>

<style lang="scss">
.navbar {
  .logout {
    a {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  }
}
</style>
