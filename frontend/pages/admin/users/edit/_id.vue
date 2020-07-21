<template>
  <modal-update v-model="record" :title="record.fullname" :url="url">
    <template slot="fields">
      <b-form-group label="Username">
        <b-form-input v-model.trim="record.username" autofocus required />
      </b-form-group>

      <b-form-group label="Password">
        <b-input-group>
          <b-form-input v-model.trim="record.password" />
          <b-input-group-append>
            <b-button tabindex="-1" @click.prevent="record.password = $password(8)">
              <fa :icon="['fas', 'key']" />
            </b-button>
          </b-input-group-append>
        </b-input-group>
      </b-form-group>

      <b-form-group label="Fullname">
        <b-form-input v-model.trim="record.fullname" required />
      </b-form-group>

      <b-form-group label="User group">
        <b-form-select v-model="record.role_id" :options="roles" required text-field="title" value-field="id" />
      </b-form-group>

      <b-form-group>
        <b-form-checkbox v-model.number="record.active">Active</b-form-checkbox>
      </b-form-group>
    </template>
  </modal-update>
</template>

<script>
import {faKey} from '@fortawesome/free-solid-svg-icons'

export default {
  async asyncData({app, params, error}) {
    try {
      const [{data: roles}, {data: record}] = await Promise.all([
        app.$axios.get('admin/user-roles', {params: {limit: 0}}),
        app.$axios.get('admin/users', {params}),
      ])
      record.password = null // For vue watcher

      return {
        record,
        roles: roles.rows,
      }
    } catch (e) {
      error({statusCode: e.statusCode, message: e.data})
    }
  },
  data() {
    return {
      url: 'admin/users',
      roles: [],
      record: {},
    }
  },
  created() {
    this.$fa.add(faKey)
  },
}
</script>
