<template>
  <modal-delete v-model="record" :url="url" title="Внимание!" submit-variant="danger">
    <template slot="fields">
      <b-form-group>
        <p>
          Вы уверены что хотите удалить подразделение: <strong>{{ record.title }}</strong
          >?
        </p>
        <p>Это действие невозможно будет отменить.</p>
      </b-form-group>
    </template>
  </modal-delete>
</template>

<script>
export default {
  async asyncData({app, params}) {
    try {
      const {data: record} = await app.$axios.get('dicts/units', {params})
      return {record}
    } catch (e) {
      error({statusCode: e.statusCode, message: e.data})
    }
  },
  data() {
    return {
      url: 'dicts/units',
      record: {},
    }
  },
}
</script>
