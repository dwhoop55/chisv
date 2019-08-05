// v-model safe
<template>
  <div>
    <input type="hidden" size="150" name="languages" :value="JSON.stringify(value)" />
    <b-taginput
      v-model="value"
      :data="filteredTags"
      autocomplete
      field="name"
      icon="label"
      :attached="true"
      placeholder="Which language(s) do you speak?"
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
      isFetching: false
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

