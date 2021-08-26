<template>
  <modal-create v-model="record" :url="url" title="Внесение новой ВКР" size="lg">
    <template slot="fields">
      <form-vkr :record="record"></form-vkr>
    </template>
  </modal-create>
</template>

<script>
import FormVkr from '../../components/forms/vkrs'
export default {
  components: {FormVkr},
  data() {
    return {
      url: 'admin/vkr-works',
      record: {
        id: null,
        author: null,
        title_vkr: null,
        type_vkr: null,
        scientific_director: null,
        year_pub: null,
        count_pages: null,
        keywords: null,
        annotation: null,
        file: {},
      },
    }
  },
}
</script>
