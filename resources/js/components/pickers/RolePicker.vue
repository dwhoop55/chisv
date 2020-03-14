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
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["value", "disabled"],

  data() {
    return {
      isLoading: true
    };
  },

  created() {
    if (!this.roles) {
      this.isLoading = true;
      this.fetchRoles().then((this.isLoading = false));
    }
  },

  computed: mapGetters("defines", ["roles"]),
  methods: mapActions("defines", ["fetchRoles"])

  // methods: {
  //   load() {
  //     this.loading = false;
  //     api
  //       .getRoles()
  //       .then(data => {
  //         this.roles = data.data.data;
  //       })
  //       .catch(error => {
  //         throw error;
  //       })
  //       .finally(() => {
  //         this.loading = false;
  //       });
  //   }
  // }
};
</script>