<template>
  <div>
    <app-table :dir="dir" :fields="fields" :filters="filters" :sort="sort" :url="url">
      <template slot="actions">
        <nuxt-link :to="{name: 'admin-user-roles-create'}" class="btn btn-dark">
          <fa :icon="['fas', 'plus']" />
          Добавить группу
        </nuxt-link>
      </template>

      <template v-slot:cell(title)="row">
        <nuxt-link :to="{name: 'admin-user-roles-edit-id', params: {id: row.item.id}}">
          {{ row.value }}
        </nuxt-link>
      </template>
      <template v-slot:cell(actions)="row">
        <nuxt-link :to="{name: 'admin-user-roles-edit-id', params: {id: row.item.id}}" class="btn btn-sm btn-secondary">
          <fa :icon="['fas', 'edit']" />
        </nuxt-link>
        <nuxt-link :to="{name: 'admin-user-roles-delete-id', params: {id: row.item.id}}" class="btn btn-sm btn-danger">
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
    return !app.$auth.loggedIn || app.$auth.hasScope('users') || app.$auth.hasScope('users/get')
  },
  data() {
    return {
      url: 'admin/user-roles',
      fields: [
        {key: 'id', label: 'ID', sortable: true},
        {key: 'title', label: 'Наименование'},
        {key: 'scope', label: 'Области доступа', formatter: this.formatScopes},
        {key: 'users_count', label: 'Пользователи'},
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
  methods: {
    formatScopes: (val) => {
      return val.join(', ')
    },
  },
}
</script>
