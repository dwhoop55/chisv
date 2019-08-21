<template>
  <b-select
    @input="$emit('input', $event)"
    :value="value"
    expanded
    :loading="loading"
    placeholder="Select a state"
  >
    <option
      v-for="state in filteredStates"
      :value="state.id"
      :key="state.id"
    >{{ state.name | capitalize }} ({{ state.description }})</option>
  </b-select>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["value", "range"],

  data() {
    return {
      states: [],
      loading: true
    };
  },

  created() {
    this.load();
  },

  destroyed() {
    this.$emit("input", null);
  },

  computed: {
    filteredStates: function() {
      return this.states.filter(
        function(state) {
          return state.id >= this.range[0] && state.id <= this.range[1];
        }.bind(this)
      );
    }
  },

  methods: {
    load() {
      this.loading = false;
      api
        .getStates()
        .then(data => {
          this.states = data.data.data;
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