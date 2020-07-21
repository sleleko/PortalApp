<template>
  <div>
    <b-row class="justify-content-center justify-content-md-between" no-gutters>
      <slot name="actions" />

      <slot name="search">
        <b-input-group v-if="filters.query !== undefined" class="mt-2 mt-md-0 ml-md-auto col-md-4">
          <b-form-input v-model="filters.query" placeholder="Search..." variant="dark" />
          <b-input-group-append>
            <b-button :disabled="!filters.query" variant="dark" @click.prevent="filters.query = ''">
              <fa :icon="['fas', 'times']" />
            </b-button>
          </b-input-group-append>
        </b-input-group>
      </slot>
    </b-row>
  </div>
</template>

<script>
import {faTimes} from '@fortawesome/free-solid-svg-icons'

export default {
  name: 'TableFilter',
  props: {
    filters: {
      type: Object,
      required: false,
      default() {
        return {}
      },
    },
    table: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      showFilters: this.visible === true,
    }
  },
  watch: {
    filters: {
      deep: true,
      handler() {
        this.$root.$emit('app::' + this.table + '::update', this.filters)
      },
    },
  },
  created() {
    this.$fa.add(faTimes)
  },
}
</script>
