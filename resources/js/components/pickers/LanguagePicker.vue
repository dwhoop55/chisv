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
      filteredTags: [
        {
          id: 3,
          user: {
            first_name: "Tina",
            last_name: "Gilbert"
          },
          date: "2016/04/26 06:26:28",
          gender: "Female"
        }
      ],
      isLoading: false
    };
  },
  methods: {
    getLanguage: debounce(function(text) {
      if (!text.length) {
        this.filteredTags = [];
        return;
      }
      this.isLoading = true;
      axios
        .get(`search/language/${text}`)
        .then(data => {
          console.log(data);
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
    }, 10)
  }
};
</script>