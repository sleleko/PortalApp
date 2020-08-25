import Vue from "vue";

import "filepond/dist/filepond.min.css";
import vueFilePond from "vue-filepond";

import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileEncode from "filepond-plugin-file-encode";

import UploadFile from "../components/upload-file";
import UploadImage from "../components/upload-image";

const FilePond = vueFilePond(
  // FilePondPluginImageTransform,
  FilePondPluginFileValidateType,
  // FilePondPluginImageExifOrientation,
  // FilePondPluginImagePreview,
  // FilePondPluginImageCrop,
  // FilePondPluginImageResize,
  FilePondPluginFileEncode
  // FilePondPluginImageEdit
);

Vue.component("file-pond", FilePond);
Vue.component("upload-file", UploadFile);
Vue.component("upload-image", UploadImage);
