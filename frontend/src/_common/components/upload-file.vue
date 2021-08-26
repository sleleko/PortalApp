<template>
  <file-pond
      ref="filepond"
      className="upload-file"
      :acceptedFileTypes="acceptedFileTypes"
      :labelIdle="label"
      :allow-multiple="false"
      :instantUpload="false"
      :allowDrop="true"
      :allowImagePreview="false"
      :allowImageResize="false"
      :allowImageFilter="false"
      labelFileLoading="Подготовка"
      labelFileProcessing="Загрузка"
      labelTapToCancel="Отмена"
      labelFileWaitingForSize="Ожидание размера"
      stylePanelLayout="integrated"
      @addfile="addFile"
      @removefile="removeFile"/>
</template>

<script>

export default {
  name: 'upload-file',
  props: {
    value: {
      type: Object,
      required: false,
      default: {},
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
  },
  computed: {
    myValue: {
      get() {
        return this.value
      },
      set(newValue) {
        this.$emit('input', newValue)
      }
    }
  },
  methods: {
    addFile(e, file) {
      let data = {
        id: file.id,
        metadata: file.getMetadata(),
        file: file.getFileEncodeDataURL(),
      };
      data.metadata.filename = file.filename;
      data.metadata.size = file.size;
      data.metadata.type = file.type;
      this.myValue = data;
    },
    removeFile(e, file) {
      this.myValue = null;
    },
  }
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