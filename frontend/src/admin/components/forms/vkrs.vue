<template>
  <div>
    <b-row class="align-items-center">
      <b-col md="12">
        <b-form-group label="Тип ВКР">
          <b-form-select v-model="record.type_vkr">
            <option v-for="vkr_type in vkr_types" :key="vkr_type.value" :value="vkr_type.value">
              {{ vkr_type.text }}
            </option>
          </b-form-select>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="Наименование ВКР">
          <b-form-input v-model.trim="record.title_vkr" autofocus required />
          <b-form-text>Введите наименование ВКР</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="6" class="mb-3 mb-md-0">
        <b-form-group label="Автор ВКР">
          <b-form-input v-model.trim="record.author" autofocus required />
          <b-form-text>Введите автора ВКР</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="Научный руководитель">
          <b-form-input v-model.trim="record.scientific_director" />
          <b-form-text>Введите научного руководителя</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="Год публикации">
          <b-form-input v-model.trim="record.year_pub" />
          <b-form-text>Год публикации ВКР</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="Объем страниц">
          <b-form-input v-model.trim="record.count_pages" />
          <b-form-text>Объем страниц ВКР</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="Ключевые слова">
          <b-form-input v-model.trim="record.keywords" />
          <b-form-text>Ключевые слова через запятую</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="Аннотация">
          <b-form-textarea
            id="textarea"
            v-model.trim="record.annotation"
            placeholder="Введите текст..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
          <b-form-text>Текст аннотации</b-form-text>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="Скан ВКР в pdf формате">
          <upload-file
            v-model="record.file"
            :value="record.file"
            :label="record.file.title"
            accepted-file-types="application/pdf"
          />
          <b-form-text>Прикрепите скан ВКР в pdf формате</b-form-text>
        </b-form-group>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: 'FormVkr',
  props: {
    record: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      vkr_types: [
        {value: 0, text: 'Выберите тип', disabled: true},
        {value: 1, text: 'Аспирантура'},
        {value: 2, text: 'Магистратура'},
        {value: 3, text: 'Факультет ВСО'},
      ],
    }
  },
}
</script>

<style scoped></style>
