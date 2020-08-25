<template>
  <div>
    <b-container v-model="record" :url="url">
      <h1>Страница загрузки сканов паспортов для выдачи кампусных карт Газпромбанка</h1>
      <b-row>
        <b-col class="col-md-6">
          <b-form-group label="Выберите тип паспорта">
            <b-form-input v-model.trim="record.passportType" required />
          </b-form-group>
          <b-form-group label="Серия паспорта">
            <b-form-input v-model.trim="record.passportSeries" required />
          </b-form-group>
          <b-form-group label="Номер паспорта">
            <b-form-input v-model.trim="record.passportNumber" required />
          </b-form-group>
          <b-form-group label="Ваша фотография">
            <upload-file v-model="record.image" />
          </b-form-group>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'Gpb',
  data() {
    return {
      url: 'site/gpb',
      record: {
        id: null,
        passportType: [
          {value: 1, text: 'РФ'},
          {value: 2, text: 'Иностранный'},
        ],
        passportSeries: null,
        passportNumber: null,
        image: null,
      },
    }
  },
}
</script>

<!--<style scoped>-->

<!--</style>-->
