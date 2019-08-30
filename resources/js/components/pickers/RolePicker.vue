<template>
  <b-select
    @input="$emit('input', $event)"
    :disabled="disabled"
    :value="value"
    expanded
    :loading="loading"
    placeholder="Select a role"
  >
    <option v-for="role in roles" :value="role.id" :key="role.id">{{ role.name | capitalize }}</option>
  </b-select>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["value", "disabled"],

  data() {
    return {
      roles: [],
      loading: true
    };
  },

  created() {
    this.load();
  },

  methods: {
    load() {
      this.loading = false;
      api
        .getRoles()
        .then(data => {
          this.roles = data.data.data;
        })
        .catch(error => {
          throw error;
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>