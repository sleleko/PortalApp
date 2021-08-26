<template>
  <modal-delete v-model="record" :url="url" title="Внимание!" submit-variant="danger">
    <template slot="fields">
      <b-form-group>
        <p>
          Вы уверены что хотите удалить запись изменения ФОТ от
          <strong>{{ record.title_vkr }}, автора: {{ record.author }}</strong
          >?
        </p>
        <p>Это действие невозможно будет отменить.</p>
      </b-form-group>
    </template>
  </modal-delete>
</template>

<script>
export default {
  async asyncData({app, params, error}) {
    try {
      const {data: record} = await app.$axios.get('admin/vkr-works', {params})
      return {record}
    } catch (e) {
      error({statusCode: e.statusCode, message: e.data})
    }
  },
  data() {
    return {
      url: 'admin/vkr-works',
      record: {},
    }
  },
}
</script>
