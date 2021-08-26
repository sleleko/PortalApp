<template>
  <div>
    <app-table :dir="dir" :fields="fields" :filters="filters" :sort="sort" :url="url">
      <template slot="actions">
        <nuxt-link :to="{name: 'vkr-create'}" class="btn btn-dark">
          <fa :icon="['fas', 'plus']" />
          Добавить ВКР
        </nuxt-link>
      </template>

      <template v-slot:cell(username)="row">
        <nuxt-link :to="{name: 'vkr-edit-id', params: {id: row.item.id}}">
          {{ row.value }}
        </nuxt-link>
      </template>
      <template v-slot:cell(file)="row">
        <a v-if="row.value" :href="$file(row.value)" target="_blank" rel="noreferrer">
        </a>
      </template>
      <template v-slot:cell(actions)="row">
        <nuxt-link :to="{name: 'vkr-edit-id', params: {id: row.item.id}}" class="btn btn-sm btn-secondary">
          <fa :icon="['fas', 'edit']" />
        </nuxt-link>
        <nuxt-link :to="{name: 'vkr-delete-id', params: {id: row.item.id}}" class="btn btn-sm btn-danger">
          <fa :icon="['fas', 'times']" />
        </nuxt-link>
      </template>
    </app-table>

    <nuxt-child />
  </div>
</template>

<script>
import {faEdit, faPlus, faTimes} from '@fortawesome/free-solid-svg-icons'

export default {
  validate({app}) {
    return (
      !app.$auth.loggedIn || app.$auth.hasScope('users') || app.$auth.hasScope('users/get') || app.$auth.hasScope('vkr')
    )
  },
  data() {
    return {
      url: 'admin/vkr-works',
      fields: [
        {key: 'id', label: 'ID', sortable: true},
        {key: 'title_vkr', label: 'Наименование ВКР'},
        {key: 'author', label: 'Автор ВКР'},
        {key: 'scientific_director', label: 'Научный руководитель'},
        {key: 'year_pub', label: 'Год публикации'},
        {key: 'count_pages', label: 'Объем'},
        {key: 'file', label: 'Файл'},
        {key: 'actions', label: 'Действия'},
      ],
      filters: {
        query: null,
      },
      sort: 'id',
      dir: 'asc',
    }
  },
  created() {
    this.$fa.add(faPlus, faEdit, faTimes)
  },
}
</script>
