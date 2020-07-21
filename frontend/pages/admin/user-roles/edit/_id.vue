<template>
  <modal-update v-model="record" :title="record.title" :url="url">
    <template slot="fields">
      <b-form-group label="Title">
        <b-form-input v-model.trim="record.title" autofocus required />
      </b-form-group>

      <b-form-group description="Comma-separated list of permissions for this group" label="Scopes">
        <b-form-input v-model.trim="record.scope" />
      </b-form-group>
    </template>
  </modal-update>
</template>

<script>
export default {
  async asyncData({app, params, error}) {
    try {
      const {data: record} = await app.$axios.get('admin/user-roles', {params})
      record.scope = record.scope.join(', ')
      return {record}
    } catch (e) {
      error({statusCode: e.statusCode, message: e.data})
    }
  },
  data() {
    return {
      url: 'admin/user-roles',
      record: {},
    }
  },
}
</script>
