<template>
  <modal-delete v-model="record" :url="url" submit-variant="danger" title="Внимание">
    <template slot="fields">
      <b-form-group>
        <p>
          Вы действительно хотите удалить пользователя <strong>{{ record.fullname }}</strong
          >?
        </p>
        <p>Это действие невозможно отменить.</p>
      </b-form-group>
    </template>
  </modal-delete>
</template>

<script>
export default {
  async asyncData({app, params, error}) {
    try {
      const {data: record} = await app.$axios.get('admin/users', {params})
      return {record}
    } catch (e) {
      error({statusCode: e.statusCode, message: e.data})
    }
  },
  data() {
    return {
      url: 'admin/users',
      record: {},
    }
  },
}
</script>
