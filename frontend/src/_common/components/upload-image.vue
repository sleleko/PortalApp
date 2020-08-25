<template>
  <div>
    <file-pond
      ref="uploadimage"
      acceptedFileTypes="image/jpeg, image/png"
      className="upload-image"
      :allow-multiple="false"
      :instantUpload="false"
      :allowDrop="true"
      :imageResizeTargetWidth="maxHeight"
      :imageResizeTargetHeight="maxWidth"
      :imagePreviewMaxHeight="300"
      :imagePreviewHeight="176"
      :imageResizeUpscale="false"
      :imageEditInstantEdit="instantEdit"
      imageResizeMode="contain"
      :labelIdle="label"
      labelFileLoading="Подготовка"
      labelFileProcessing="Загрузка"
      labelTapToCancel="Отмена"
      labelFileWaitingForSize="Ожидание размера"
      stylePanelLayout="integrated"
      @addfile="addFile"
      @removefile="removeFile"
    />
<!--    <div class="upload-image-placeholder">-->
<!--      <img alt="" height="176" :src="value" />-->
<!--    </div>-->
  </div>
</template>

<script>
export default {
  name: 'upload-image',
  data() {
    return {}
  },
  props: {
    value: {
      type: Object,
      required: false,
    },
    label: {
      type: String,
      required: false,
      default: 'Нажмите для загрузки, либо перетащите сюда фотографию',
    },
    maxWidth: {
      type: Number,
      required: false,
      default: 1920,
    },
    maxHeight: {
      type: Number,
      required: false,
      default: 1080,
    },
    instantEdit: {
      type: Boolean,
      default: true,
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
    // placeholder() {
    //   return this.label
    //       ? this.$image(this.label, '466x176')
    //       : 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=='
    // }
  },
  methods: {
    // initDoka() {
    //   return Doka.create({
    //     utils: ['crop'],
    //     cropAllowImageTurnLeft: true,
    //     cropAllowImageTurnRight: true,
    //     cropAllowImageFlipHorizontal: false,
    //     cropAllowImageFlipVertical: false,
    //     //cropAllowRotate: false,
    //     cropAspectRatio: false,
    //     labelButtonConfirm: 'Сохранить',
    //     labelButtonCancel: 'Отмена',
    //     labelButtonCropRotateLeft: 'Повернуть налево',
    //     labelButtonCropRotateRight: 'Повернуть направо',
    //     labelStatusLoadingImage: 'Загрузка изображения...',
    //     labelStatusProcessingImage: 'Обработка изображения...',
    //   })
    // },
    addFile(e, file) {
      const metadata = file.getMetadata()
      metadata.name = file.file.name
      metadata.type = file.file.type
      metadata.size = file.file.size
      this.myValue = {
        id: file.id,
        metadata,
        file: file.getFileEncodeDataURL(),
      }
    },
    removeFile(e, file) {
      this.myValue = null
    },
  },
}
</script>

<style lang="scss">
.upload-image {
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
