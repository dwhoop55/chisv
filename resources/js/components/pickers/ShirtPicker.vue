// v-model safe
<template>
  <b-select
    required
    :loading="isLoading"
    :value="value"
    placeholder="Select your cut and size"
    icon="tshirt-crew"
    @input="input"
  >
    <option
      v-for="shirt in shirts"
      :value="shirt.id"
      :key="shirt.id"
    >{{ shirt.cut }} cut, size {{ shirt.size }}</option>
  </b-select>
</template>

<script>
import api from "@/api";
export default {
  props: ["value"],

  data() {
    return {
      isLoading: true,
      shirts: []
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
      .getShirts()
      .then(({ data }) => (this.shirts = data))
      .finally(() => (this.isLoading = false));
  }
};
</script>
