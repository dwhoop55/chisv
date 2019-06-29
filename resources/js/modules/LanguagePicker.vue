<template>
  <b-field horizontal expanded>
    <template slot="label">
      Languages
      <b-tooltip position="is-right" label="Please choose all languages that you speak">
        <b-icon size="is-small" icon="help-circle-outline"></b-icon>
      </b-tooltip>
    </template>
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
  </b-field>
</template>

<script>
import debounce from "lodash/debounce";

export default {
  name: "language-picker",
  props: ["url"],
  data() {
    return {
      filteredTags: [],
      isFetching: false,
      tags: []
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
        .get(`${this.url}${text}`)
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

