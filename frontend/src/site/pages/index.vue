<template>
  <div>
    <h1 class="text-center">Выпускные квалификационные работы</h1>
    <hr />
    <b-container class="mt-5">
      <b-row>
        <!--        <b-col class="col-12">-->
        <!--          <b-alert v-if="!vkr_asp.length && !vkr_mag.length && !vkr_vso.length" variant="info" :show="true">-->
        <!--            В системе не загружена ни одна выпускная квалификационная работа!-->
        <!--          </b-alert>-->
        <!--          <div v-else>-->
        <!--            <h4>Категории ВКР</h4>-->
        <!--            <h5 v-if="vkr_asp.length" class="mt-5">Аспирантура</h5>-->
        <!--            <div class="row">-->
        <!--              <div v-for="item of vkr_asp" :key="item.id" class="col-4 mt-2 mb-2">-->
        <!--                <b-card :title="item.title_vkr" :sub-title="'Автор: ' + item.author">-->
        <!--                  <b-card-text>Научный руководитель: {{ item.scientific_director }}</b-card-text>-->
        <!--                  <b-card-text>Аннотация: {{ item.annotation }} </b-card-text>-->
        <!--                  <b-card-text>Объем работы в страницах: {{ item.count_pages }}</b-card-text>-->
        <!--                  <b-card-text>Год публикации: {{ item.year_pub }}</b-card-text>-->
        <!--                  <b-link :href="$file(item.file)" class="card-link">Скачать файл ВКР в pdf формате</b-link>-->
        <!--                </b-card>-->
        <!--              </div>-->
        <!--            </div>-->
        <!--            <h5 v-if="vkr_mag.length" class="mt-5">Магистратура</h5>-->
        <!--            <div class="row">-->
        <!--              <div v-for="item of vkr_mag" :key="item.id" class="col-4 mt-2 mb-2">-->
        <!--                <b-card :title="item.title_vkr" :sub-title="'Автор: ' + item.author">-->
        <!--                  <b-card-text>Научный руководитель: {{ item.scientific_director }}</b-card-text>-->
        <!--                  <b-card-text>Аннотация: {{ item.annotation }} </b-card-text>-->
        <!--                  <b-card-text>Объем работы в страницах: {{ item.count_pages }}</b-card-text>-->
        <!--                  <b-card-text>Год публикации: {{ item.year_pub }}</b-card-text>-->
        <!--                  <b-link :href="$file(item.file)" class="card-link">Скачать файл ВКР в pdf формате</b-link>-->
        <!--                </b-card>-->
        <!--              </div>-->
        <!--            </div>-->
        <!--            <h5 v-if="vkr_vso.length" class="mt-5">Факультет ВСО</h5>-->
        <!--            <div class="row">-->
        <!--              <div v-for="item of vkr_vso" :key="item.id" class="col-4 mt-2 mb-2">-->
        <!--                <b-card :title="item.title_vkr" :sub-title="'Автор: ' + item.author">-->
        <!--                  <b-card-text>Научный руководитель: {{ item.scientific_director }}</b-card-text>-->
        <!--                  <b-card-text>Аннотация: {{ item.annotation }} </b-card-text>-->
        <!--                  <b-card-text>Объем работы в страницах: {{ item.count_pages }}</b-card-text>-->
        <!--                  <b-card-text>Год публикации: {{ item.year_pub }}</b-card-text>-->
        <!--                  <b-link :href="$file(item.file)" class="card-link">Скачать файл ВКР в pdf формате</b-link>-->
        <!--                </b-card>-->
        <!--              </div>-->
        <!--            </div>-->
        <!--          </div>-->
        <!--        </b-col>-->
        <b-col class="col-12"></b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  // name: 'Index',
  async asyncData({app}) {
    const data = {
      vkr_asp: [],
      vkr_mag: [],
      vkr_vso: [],
    }
    const loadData = await app.$axios.$get('admin/vkr-works', {params: {limit: 0}})
    // console.log(loadData.rows)
    loadData.rows.forEach((v) => {
      // console.log(v.file)
      if (v.type_vkr === 1) {
        data.vkr_asp.push(v)
      } else if (v.type_vkr === 2) {
        data.vkr_mag.push(v)
      } else if (v.type_vkr === 3) {
        data.vkr_vso.push(v)
      }
    })

    return data
  },
}
</script>

<style scoped></style>
