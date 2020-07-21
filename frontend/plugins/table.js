import Vue from 'vue'
import TableFilter from '../components/table-filter'
import TableFooter from '../components/table-footer'
import AppTable from '../components/app-table'

Vue.component('table-filter', TableFilter)
Vue.component('table-footer', TableFooter)
Vue.component('app-table', AppTable)

export default ({app}, inject) => {
  Vue.prototype.loadTable = (ctx, $component, action) => {
    const params = {
      page: ctx.currentPage,
      limit: ctx.perPage,
      sort: ctx.sortBy,
      dir: ctx.sortDesc ? 'desc' : 'asc',
    }
    for (const i in $component.filters) {
      if (Object.prototype.hasOwnProperty.call($component.filters, i) && $component.filters[i] !== undefined) {
        params[i] = $component.filters[i]
      }
    }

    if (action === undefined) {
      action = $component.$options.name
    }

    $component.busy = true

    return app.$axios
      .get(action, {params})
      .then((res) => {
        const items = res.data
        $component.totalRows = items.total || 0

        return items.rows || []
      })
      .catch(() => {})
      .finally(() => {
        $component.busy = false
      })
  }
}
