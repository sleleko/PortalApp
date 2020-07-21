<template>
  <b-modal ref="modal" :size="size" :title="title" hide-footer visible @hidden="onHidden">
    <slot name="form">
      <b-form @submit.prevent="Submit">
        <slot name="fields" />
        <slot name="buttons">
          <b-row class="mt-2 justify-content-between" no-gutters>
            <b-button :disabled="loading" variant="secondary" @click="$refs.modal.hide()">
              Cancel
            </b-button>
            <b-button :disabled="loading" :variant="submitVariant" type="submit">
              <b-spinner v-if="loading" small />
              Submit
            </b-button>
          </b-row>
        </slot>
      </b-form>
    </slot>
  </b-modal>
</template>

<script>
export default {
  name: 'ModalCreate',
  props: {
    url: {
      type: String,
      required: true,
    },
    value: {
      type: Object,
      required: false,
      default() {
        return {}
      },
    },
    name: {
      type: String,
      required: false,
      default() {
        return this.url.replace('/', '-')
      },
    },
    title: {
      type: String,
      required: false,
      default: 'New item',
    },
    size: {
      type: String,
      required: false,
      default: 'md',
    },
    beforeSubmit: {
      type: Function,
      required: false,
      default(record) {
        return record
      },
    },
    submitVariant: {
      type: String,
      required: false,
      default: 'primary',
    },
  },
  data() {
    return {
      loading: false,
    }
  },
  computed: {
    record: {
      get() {
        return this.value
      },
      set(newValue) {
        this.$emit('input', newValue)
      },
    },
  },
  methods: {
    onHidden() {
      if (this.$listeners.onHidden) {
        this.$listeners.onHidden(this.name)
      } else {
        this.$router.go(-1)
      }
    },
    async Submit() {
      try {
        let record = JSON.parse(JSON.stringify(this.record))
        record = this.beforeSubmit(record)
        if (record === false) {
          return
        }
        this.loading = true
        const {data} = await this.$axios.put(this.url, record)
        if (this.$listeners.onSubmitted) {
          this.$listeners.onSubmitted(data)
        } else {
          this.$refs.modal.hide()
        }
        this.$root.$emit(`app::${this.name}::update`, data)
      } catch (e) {
      } finally {
        this.loading = false
      }
    },
  },
}
</script>
