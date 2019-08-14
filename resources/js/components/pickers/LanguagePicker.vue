// v-model safe
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
      @typing="getLanguage"
    ></b-taginput>
  </div>
</template>

<script>
import debounce from "lodash/debounce";

export default {
  props: ["value"],
  data() {
    return {
      filteredTags: [],
      fetching: false
    };
  },
  methods: {
    getLanguage: debounce(function(text) {
      if (!text.length) {
        this.filteredTags = [];
        return;
      }
      this.fetching = true;
      axios
        .get(`search/language/${text}`)
        .then(({ data }) => {
          this.filteredTags = [];
          data.data.forEach(entry => this.filteredTags.push(entry));
        })
        .catch(error => {
          this.rows = [];
          throw error;
        })
        .finally(() => {
          this.fetching = false;
        });
    }, 10)
  }
};
</script>