<template>
  <div>
    <b-taginput
      :value="value"
      :data="filteredTags"
      autocomplete
      field="name"
      :attached="true"
      icon="tag"
      placeholder="Pick your spoken languages"
      @input="$emit('input', $event)"
      v-debounce:100ms="getLanguage"
      :debounce-events="'typing'"
    ></b-taginput>
  </div>
</template>

<script>
import api from "@/api";

export default {
  props: ["value"],
  data() {
    return {
      filteredTags: [],
      isLoading: false
    };
  },
  methods: {
    getLanguage(text) {
      if (!text || !text.length) {
        this.filteredTags = [];
        return;
      }
      this.isLoading = true;
      api
        .getLanguage(text)
        .then(({ data }) => (this.filteredTags = data))
        .catch(error => (this.filteredTags = []))
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>