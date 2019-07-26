<template>
  <div>
    <input type="hiddent" name="languages" :value="JSON.stringify(tags)" />
    <b-taginput
      v-model="tags"
      :data="filteredTags"
      autocomplete
      field="name"
      icon="label"
      :attached="true"
      placeholder="Which language(s) do you speak?"
      @typing="getLanguage"
      @input="$emit('update:tags', $event)"
    ></b-taginput>
  </div>
</template>

<script>
import debounce from "lodash/debounce";

export default {
  name: "language-picker",
  props: ["url", "selected"],
  data() {
    return {
      filteredTags: [],
      isFetching: false,
      tags: this.selected
    };
  },
  methods: {
    getLanguage: debounce(function(text) {
      if (!text.length) {
        this.filteredTags = [];
        return;
      }
      this.isFetching = true;
      axios
        .get(`/api/search/language/${text}`)
        .then(({ data }) => {
          this.filteredTags = [];
          data.data.forEach(entry => this.filteredTags.push(entry));
        })
        .catch(error => {
          this.rows = [];
          throw error;
        })
        .finally(() => {
          this.isFetching = false;
        });
    }, 10)
  }
};
</script>

<style scoped>
.notification-no-padding {
  padding: 0 !important;
}
</style>

