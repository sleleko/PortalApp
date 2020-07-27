<template>
  <modal-update v-model="record" :url="url" :title="title" size="lg" tab-title="Изменение подразделения">
    <template slot="fields">
      <form-unit :record="record" />
    </template>
  </modal-update>
</template>

<script>
import {faPlus, faEdit, faTimes} from '@fortawesome/free-solid-svg-icons'
import FormUnit from '../../../../components/forms/units'
export default {
  components: {FormUnit},
  async asyncData({app, params, error}) {
    try {
      const {data: record} = await app.$axios.get('dicts/units', {params})
      return {record}
    } catch (e) {
      error({statusCode: e.statusCode, message: e.response.data})
    }
  },
  data() {
    return {
      url: 'dicts/units',
      record: {},
      title: 'Изменение подразделение',
    }
  },

  created() {
    this.$fa.add(faPlus, faEdit, faTimes)
  },
}
</script>
