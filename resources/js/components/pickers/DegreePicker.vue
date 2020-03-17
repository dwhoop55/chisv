// v-model safe
<template>
  <b-select
    required
    :loading="isLoading"
    :value="value"
    placeholder="Select your current degree program"
    icon="school"
    @input="input"
  >
    <option v-for="option in degrees" :value="option.id" :key="option.id">{{ option.name }}</option>
  </b-select>
</template>

<script>
import api from "@/api";
export default {
  props: ["value"],

  model: {},
  data() {
    return {
      isLoading: true,
      degrees: []
    };
  },

  methods: {
    input: function(event) {
      if (Number.isInteger(event)) {
        this.$emit("input", event);
      }
    }
  },

  created() {
    api
      .getDegrees()
      .then(({ data }) => (this.degrees = data))
      .catch(error => (this.degrees = []))
      .finally(() => (this.isLoading = false));
  }
};
</script>
