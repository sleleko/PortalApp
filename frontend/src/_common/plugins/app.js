export default ({app, store}, inject) => {
  inject('file', (data) => {
    const params = [app.$settings.file_url]
    params.push(/^\d+$/.test(data) ? data : data.id)
    let url = params.join('/')
    if (data.updated_at) {
      url += '?t=' + new Date(data.updated_at).getTime()
    }

    return url
  })
}