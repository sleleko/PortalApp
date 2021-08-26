export default ({app, $axios}, inject) => {
  const settings = {
    image_url: $axios.defaults.baseURL.replace('api/', 'image'),
    file_url: $axios.defaults.baseURL.replace('api/', 'file'),
  }

  inject('settings', settings)
}