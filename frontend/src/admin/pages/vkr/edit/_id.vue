<template>
  <modal-update v-model="record" :url="url" :title="title" size="lg" tab-title="Редактирование записи ВКР">
    <template slot="fields">
      <form-vkr :record="record" />
    </template>
  </modal-update>
</template>

<script>
import {faPlus, faEdit, faTimes} from '@fortawesome/free-solid-svg-icons'
import FormVkr from '../../../components/forms/vkrs'
export default {
  components: {FormVkr},
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
      title: 'Редактирование записи ВКР',
    }
  },

  created() {
    this.$fa.add(faPlus, faEdit, faTimes)
  },
}
</script>
