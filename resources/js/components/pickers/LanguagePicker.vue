<template>
  <div>
    <b-taginput
      :value="value"
      :data="filteredTags"
      autocomplete
      field="name"
      icon="label"
      :attached="true"
      placeholder="Which language(s) do you speak?"
      @input="$emit('input', $event)"
      v-debounce:100ms="getLanguage"
      :debounce-events="'typing'"
    ></b-taginput>
  </div>
</template>

<script>
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
      axios
        .get(`search/language/${text}`)
        .then(data => {
          this.filteredTags = [];
          data.data.data.forEach(entry => this.filteredTags.push(entry));
        })
        .catch(error => {
          this.rows = [];
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>