<template>
  <div>
    <b-container>
      <h1>Страница загрузки фото и заявления для выдачи кампусных карт Газпромбанка</h1>
      <b-row>
        <b-col class="col-md-6">
          <b-form>
            <b-form-group label="Выберите тип паспорта">
              <b-form-select
                v-model="record.passportType"
                :options="types"
                value-field="id"
                text-field="title"
                :state="checkType"
                required
              />
            </b-form-group>
            <b-form-group label="Серия паспорта">
              <b-form-input v-model.trim="record.passportSeries" :state="checkPassportSeries" required />
            </b-form-group>
            <b-form-group label="Номер паспорта">
              <b-form-input v-model.trim="record.passportNumber" :state="checkPassportNumber" required />
            </b-form-group>
            <b-form-group label="Скан заявления на выпуск карты (Только в PDF формате)">
              <upload-file v-model="record.acceptance" accepted-file-types="application/pdf" :state="checkAcceptance" />
              <template v-if="!checkAcceptance">
                <b-alert variant="danger" class="mt-2" show>Вы не прикрепили скан заяления</b-alert>
              </template>
            </b-form-group>
            <b-form-group label="Ваша фотография (Только в JPEG формате и строго в соответствии с требованиями справа)">
              <upload-image v-model="record.image" :state="checkImage" />
              <template v-if="!checkImage">
                <b-alert variant="danger" class="mt-2" show>Вы не прикрепили своё фото</b-alert>
              </template>
            </b-form-group>
            <b-form-group>
              <b-form-checkbox
                id="checkbox-1"
                v-model="record.agreement"
                name="agreement"
                value="true"
                unchecked-value="false"
                :state="checkAgreement"
              >
                Я даю согласие на обработку моих персональных данных в соотвествии с
                <a
                  href="https://www.tyumsmu.ru/upload/iblock/bc8/Soglashenie-na-obrabotku-personalnykh-dannykh.pdf"
                  target="_blank"
                >
                  соглашением на обработку персональных данных</a
                >
              </b-form-checkbox>
            </b-form-group>
            <b-form-group>
              <b-button type="reset" variant="danger" @click="onReset">
                Очистить
              </b-button>
              <b-button variant="success" :disabled="beforeCheck" @click="onSubmit">
                <b-spinner v-if="loading" small />
                Отправить
              </b-button>
            </b-form-group>
          </b-form>
        </b-col>
        <b-col class="col-md-6">
          <b-card title="Инструкция по заполнению формы" sub-title="">
            <b-card-text>
              <ul>
                <li>Выберите тип паспорта;</li>
                <li>Укажите серию паспорта 4 цифры. Если у вас иностранный паспорт без серии, то укажите 0000;</li>
                <li>Укажите номер паспорта 6 цифр. Если у вас иностранный паспорт, то его номер целиком;</li>
                <li>
                  Скачайте бланк заявления на выпуск карты по <a href="/blank.doc" target="_blank">этой ссылке</a>,
                  отсканируйте в pdf формате и прикрепите в поле "Скан заявления на выпуск карты";
                </li>
                <li>
                  <strong
                    >ВНИМАНИЕ!!!: Размер каждого из файлов не должен превышать 3мб, и обязательно дожидайтесь окончания
                    загрузки файла в поле (появится кнопочка крестик);
                  </strong>
                </li>
                <li>
                  <strong
                    >Если ваш браузер возвращает сообщение о невозможности скачать файл по ссылке, нажмите по ней правой
                    правой кнопкой мыши и выберите пункт меню "Сохранить как";
                  </strong>
                </li>
                <li>
                  Если вам не понятно как ее заполнять, скайте и изучите образец заполнения заявления по
                  <a href="/example.pdf" target="_blank">этой ссылке</a>
                </li>
                <li>Прикрепите свою фотографию, которая соответсвует следующим требованиям:</li>
                <ul>
                  <li>Формат файла: JPEG</li>
                  <li>Разрешение: 300 dpi, цветная.</li>
                  <li>Ваше лицо должно быть по центру снимка</li>
                  <li>Размер: 2x2 см.</li>
                  <li>Соотношение сторон: 1 к 1</li>
                </ul>
                <li>
                  В случае возникновения ошибки, в нижней части экрана справа всплывает уведомление в красном окошке с
                  текстом ошибки;
                </li>
                <li>
                  В случае успешеой отправки, в нижней части экрана справа вспывет уведомление в зеленом окошке об
                  успешности отправки.
                </li>
                <li><strong>В случае возникновения проблем, сообщите +7 (3452) 20-07-07</strong></li>
              </ul>
            </b-card-text>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'GpbCardForm',
  data() {
    return {
      loading: false,
      url: 'site/gpb-images',
      types: [
        {id: null, title: 'Выберите тип'},
        {id: 1, title: 'Паспорт РФ'},
        {id: 2, title: 'Паспорт иностранного гражданина'},
      ],
      record: {
        // id: null,
        passportType: null,
        passportSeries: null,
        passportNumber: null,
        acceptance: null,
        image: null,
      },
    }
  },
  computed: {
    checkType() {
      return this.record.passportType != null
    },
    // eslint-disable-next-line vue/return-in-computed-property
    checkPassportSeries() {
      return this.record.passportSeries != null && this.record.passportSeries.length === 4
    },
    checkPassportNumber() {
      return (
        this.record.passportNumber != null &&
        this.record.passportNumber.length >= 6 &&
        this.record.passportNumber.length <= 12
      )
    },
    checkAcceptance() {
      return this.record.acceptance != null
    },
    checkImage() {
      return this.record.image != null
    },
    checkAgreement() {
      return this.record.agreement != null
    },
    beforeCheck() {
      return !this.record.agreement
    },
  },
  methods: {
    async onSubmit() {
      try {
        const record = JSON.parse(JSON.stringify(this.record))
        this.loading = true
        const {data} = await this.$axios.post(this.url, record)
        // console.log(data)
        this.$notify.success({message: 'Форма успешно отправлена!'})
        this.onReset()
      } catch (err) {
        // console.log(err.response.data)
        this.$notify.error({message: err.response.data})
      } finally {
        this.loading = false
      }
      // this.$notify.success({message: 'Форма отправлена!'})
    },
    onReset() {
      // eslint-disable-next-line no-unused-expressions
      this.record = {
        passportType: null,
        passportSeries: null,
        passportNumber: null,
        acceptance: null,
        image: null,
        agreement: null,
      }
    },
  },
}
</script>

<style scoped>
ul li {
  margin-top: 1em;
}
</style>
