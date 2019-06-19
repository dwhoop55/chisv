<template>
  <section>
    <b-field label="Language">
      <b-taginput
        v-model="tags"
        :data="filteredTags"
        autocomplete
        field="name"
        icon="label"
        attached="true"
        placeholder="Which language(s) do you speak?"
        @typing="getLanguage"
        @input="emitChanged"
      ></b-taginput>
    </b-field>
  </section>
</template>

<script>
import debounce from "lodash/debounce";

export default {
  name: "language-picker",
  props: ["url"],
  data() {
    return {
      filteredTags: [],
      isSelectOnly: false,
      isFetching: false,
      tags: []
    };
  },
  methods: {
    emitChanged: function() {
      this.$emit("changed", this.tags);
    },
    getLanguage: debounce(function(text) {
      if (!text.length || text.length < 2) {
        this.filteredTags = [];
        return;
      }
      this.isFetching = true;
      this.$http
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
    }, 250)
  }
};
</script>
