<template>
  <div>
    <app-table :url="url" :fields="fields" :filters="filters" :sort="sort" :dir="dir">
      <template slot="actions">
        <nuxt-link :to="{name: 'admin-units-create'}" class="btn btn-dark">
          <fa :icon="['fas', 'plus']" />
          Добавить подразделение
        </nuxt-link>
      </template>

      <template v-slot:cell(title)="row">
        <nuxt-link :to="{name: 'admin-units-edit-id', params: {id: row.item.id}}">
          {{ row.value }}
        </nuxt-link>
      </template>
      <template v-slot:cell(actions)="row">
        <nuxt-link
          :to="{name: 'admin-units-edit-id', params: {id: row.item.id}}"
          class="btn btn-sm btn-secondary"
        >
          <fa :icon="['fas', 'edit']" />
        </nuxt-link>
        <nuxt-link :to="{name: 'admin-units-delete-id', params: {id: row.item.id}}" class="btn btn-sm btn-danger">
          <fa :icon="['fas', 'times']" />
        </nuxt-link>
      </template>
    </app-table>
    <nuxt-child />
  </div>
</template>

<script>
import {faPlus, faEdit, faTimes} from '@fortawesome/free-solid-svg-icons'

export default {
  name: 'GridWeeks',
  data() {
    return {
      url: 'dicts/units',
      fields: [
        {key: 'id', label: 'ID', sortable: true},
        {key: 'title', label: 'Подразделение'},
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
