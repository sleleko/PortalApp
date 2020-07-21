<template>
  <modal-delete v-model="record" :url="url" submit-variant="danger" title="Warning">
    <template slot="fields">
      <b-form-group>
        <p>
          Are you sure you want to remove user group <strong>{{ record.title }}</strong
          >?
        </p>
        <p>This can not be undone.</p>
      </b-form-group>
    </template>
  </modal-delete>
</template>

<script>
export default {
  async asyncData({app, params, error}) {
    try {
      const {data: record} = await app.$axios.get('admin/user-roles', {params})
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
