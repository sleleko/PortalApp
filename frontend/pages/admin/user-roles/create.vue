<template>
  <modal-create v-model="record" :url="url" title="Новая группа пользователя">
    <template slot="fields">
      <b-form-group label="Название">
        <b-form-input v-model.trim="record.title" autofocus required />
      </b-form-group>

      <b-form-group description="Перечислите через запятую области доступа" label="Scopes">
        <b-form-input v-model.trim="record.scope" />
      </b-form-group>
    </template>
  </modal-create>
</template>

<script>
export default {
  data() {
    return {
      url: 'admin/user-roles',
      roles: [],
      record: {
        title: null,
        scope: null,
      },
    }
  },
}
</script>
