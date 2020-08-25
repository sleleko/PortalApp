<template>
  <file-pond
    ref="uploadfile"
    class-name="upload-file"
    :accepted-file-types="acceptedFileTypes"
    :label-idle="label"
    :allow-multiple="false"
    :instant-upload="false"
    :allow-drop="true"
    :allow-image-preview="false"
    :allow-image-resize="false"
    :allow-image-filter="false"
    label-file-loading="Подготовка"
    label-file-processing="Загрузка"
    label-tap-to-cancel="Отмена"
    label-file-waiting-for-size="Ожидание размера"
    style-panel-layout="integrated"
    @addfile="addFile"
    @removefile="removeFile"
  />
</template>

<script>
export default {
  name: 'UploadFile',
  props: {
    value: {
      type: Object,
      required: false,
    },
    label: {
      type: String,
      required: false,
      default: 'Нажмите для загрузки, либо перетащите сюда файл',
    },
    acceptedFileTypes: {
      type: String,
      default: null,
    },
    state: Boolean,
    required: true
  },
  computed: {
    myValue: {
      get() {
        return this.value
      },
      set(newValue) {
        this.$emit('input', newValue)
      },
    },
  },
  methods: {
    addFile(e, file) {
      const data = {
        id: file.id,
        metadata: file.getMetadata(),
        file: file.getFileEncodeDataURL(),
      }
      data.metadata.filename = file.filename
      data.metadata.size = file.size
      data.metadata.type = file.type
      this.myValue = data
    },
    removeFile(e, file) {
      this.myValue = null
    },
  },
}
</script>

<style lang="scss">
.upload-file {
  .filepond--panel-root {
    background: transparent;
  }

  .filepond--drop-label {
    border-radius: 10px;
    border: 1px solid #333;

    > label {
      cursor: pointer;
      color: #000;
    }
  }

  .filepond--action-process-item {
    display: none;
  }
  .filepond--file {
    background: lightgray;
  }
}
</style>
