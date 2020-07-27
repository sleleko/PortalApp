<template>
  <div>
    <b-row class="align-items-center">
      <b-col md="12">
        <b-form-group label="Наименование">
          <b-form-input v-model.trim="record.title" required />
        </b-form-group>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: 'FormDict',
  props: {
    record: {
      type: Object,
      required: true,
    },
  },
}
</script>

<style scoped></style>
