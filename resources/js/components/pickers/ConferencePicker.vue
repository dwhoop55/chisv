<template>
  <b-select
    @input="$emit('input', $event)"
    :disabled="disabled"
    :value="value"
    expanded
    :loading="isLoading"
    placeholder="Select a conference"
  >
    <option
      v-for="conference in conferences"
      :value="conference.id"
      :key="conference.id"
    >{{ conference.name }}</option>
  </b-select>
</template>

<script>
import api from "@/api.js";
import { mapActions, mapGetters } from "vuex";

export default {
  props: ["value", "disabled"],

  created() {
    if (!this.conferences) {
      this.fetchConferences();
    }
  },

  methods: mapActions("conferences", ["fetchConferences"]),
  computed: mapGetters("conferences", ["isLoading", "conferences"])
};
</script>