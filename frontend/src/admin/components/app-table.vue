<template>
  <div>
    <slot name="filters">
      <table-filter :filters="filters" :table="name" :visible="filtersVisible">
        <slot v-for="(_, slotName) in $slots" :slot="slotName" :name="slotName" />
      </table-filter>
    </slot>

    <b-table
      :id="name"
      :busy="busy"
      :class="tableClass"
      :current-page="page"
      :fields="fields"
      :items="items"
      :per-page="tLimit"
      :primary-key="primaryKey"
      :sort-by.sync="tSort"
      :sort-desc="dir === 'desc'"
      :sort-direction.sync="tDir"
      :stacked="tableStacked"
      :tbody-tr-class="rowClass"
      no-local-sorting
      no-sort-reset
      show-empty
    >
      <template v-for="(_, slotName) in $scopedSlots" :slot="slotName" slot-scope="slotData">
        <slot :name="slotName" v-bind="slotData" />
      </template>
    </b-table>

    <slot name="footer">
      <table-footer
        :busy="busy"
        :limit.sync="limit"
        :page.sync="page"
        :table="name"
        :total-cost="totalCost"
        :total-rows="totalRows"
      />
    </slot>
  </div>
</template>

<script>
import TableFilter from './table-filter'
import TableFooter from './table-footer'

export default {
  name: 'AppTable',
  components: {
    TableFilter,
    TableFooter,
  },
  props: {
    fields: {
      type: Array,
      required: false,
      default() {
        return []
      },
    },
    url: {
      type: String,
      required: true,
    },
    name: {
      type: String,
      required: false,
      default() {
        return this.url.replace('/', '-')
      },
    },
    limit: {
      type: Number,
      required: false,
      default: 20,
    },
    sort: {
      type: String,
      required: false,
      default: 'id',
    },
    dir: {
      type: String,
      required: false,
      default: 'asc',
    },
    filters: {
      type: Object,
      required: false,
      default() {
        return {
          // query: '',
        }
      },
    },
    filtersVisible: {
      type: Boolean,
      default: false,
    },
    primaryKey: {
      type: String,
      default: 'id',
    },
    rowClass: {
      type: Function,
      required: false,
      default() {},
    },
    tableClass: {
      type: String,
      default: 'mt-5',
    },
    tableStacked: {
      type: String,
      default: 'md',
    },
  },
  data() {
    return {
      page: 1,
      busy: false,
      totalRows: 0,
      totalCost: null,
      pageLimit: 7,
      items: (ctx) => {
        return this.loadTable(ctx, this, this.url)
      },
    }
  },
  computed: {
    tSort: {
      get() {
        return this.sort
      },
      set(newValue) {
        this.$emit('update:sort', newValue)
      },
    },
    tDir: {
      get() {
        return this.dir
      },
      set(newValue) {
        this.$emit('update:dir', newValue)
      },
    },
    tLimit: {
      get() {
        return this.limit
      },
      set(newValue) {
        this.$emit('update:limit', newValue)
      },
    },
  },
  created() {
    this.$root.$on('app::' + this.name + '::update', () => {
      this.refresh()
    })
  },
  methods: {
    refresh() {
      this.$root.$emit('bv::refresh::table', this.name)
    },
  },
}
</script>
