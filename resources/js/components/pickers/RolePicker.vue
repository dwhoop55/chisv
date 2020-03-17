<template>
  <b-select
    @input="$emit('input', $event)"
    :disabled="disabled"
    :value="value"
    expanded
    :loading="isLoading"
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
      isLoading: false
    };
  },

  created() {
    if (!this.roles) {
      this.isLoading = true;
      this.fetchRoles().then(() => (this.isLoading = false));
    }
  },

  computed: mapGetters("defines", ["roles"]),
  methods: mapActions("defines", ["fetchRoles"])
};
</script>