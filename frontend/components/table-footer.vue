<template>
  <b-row class="justify-content-center justify-content-md-start mt-5" no-gutters>
    <b-pagination
      v-if="totalRows > limit"
      v-model="currentPage"
      :limit="pageLimit"
      :per-page="limit"
      :total-rows="totalRows"
      class="m-0"
      variant="dark"
    />

    <b-button class="ml-2 d-none d-md-block" variant="dark" @click.prevent="refresh">
      <b-spinner v-if="busy" small />
      <fa v-else :icon="['fas', 'sync']" />
    </b-button>

    <div class="btn">
      <b>{{ totalRows | number }}</b> rows
    </div>
  </b-row>
</template>

<script>
import {faSync} from '@fortawesome/free-solid-svg-icons'

export default {
  name: 'TableFooter',
  props: {
    table: {
      type: String,
      required: true,
    },
    page: {
      type: Number,
      required: true,
    },
    limit: {
      type: Number,
      required: true,
    },
    totalRows: {
      type: Number,
      required: true,
    },
    totalCost: {
      type: Number,
      required: false,
      default: null,
    },
    pageLimit: {
      type: Number,
      default: 7,
    },
    busy: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  computed: {
    currentPage: {
      get() {
        return this.page
      },
      set(newValue) {
        this.$emit('update:page', newValue)
      },
    },
  },
  created() {
    this.$fa.add(faSync)
  },
  methods: {
    refresh() {
      this.$root.$emit('bv::refresh::table', this.table)
    },
  },
}
</script>
