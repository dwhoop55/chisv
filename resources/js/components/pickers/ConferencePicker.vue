<template>
  <b-select
    @input="$emit('input', $event)"
    :value="value"
    expanded
    :loading="loading"
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

export default {
  props: ["value"],

  data() {
    return {
      conferences: [],
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
        .getConferences()
        .then(data => {
          this.conferences = data.data.data;
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