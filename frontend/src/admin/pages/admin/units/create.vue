<template>
  <modal-create v-model="record" :url="url" :title="title" size="lg">
    <template slot="fields">
      <form-unit :record="record" />
    </template>
  </modal-create>
</template>

<script>
import FormUnit from '../../../components/forms/units'
export default {
  components: {FormUnit},
  data() {
    return {
      url: 'dicts/units',
      title: 'Создание подразделения',
      record: {
        id: null,
        title: null,
      },
    }
  },
}
</script>
