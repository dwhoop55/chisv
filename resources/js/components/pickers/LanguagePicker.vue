<template>
  <div>
    <b-taginput
      :value="value"
      :data="filtered"
      autocomplete
      field="name"
      :attached="true"
      icon="tag"
      placeholder="Pick your spoken languages"
      @input="$emit('input', $event)"
      v-debounce:100ms="filter"
      :debounce-events="'typing'"
    ></b-taginput>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: ["value"],

  data() {
    return {
      filtered: null,
    };
  },

  computed: mapGetters("defines", ["languages"]),

  methods: {
    filter(text) {
      var filtered = this.languages.filter((language) =>
        language.name.toLowerCase().includes(text.toLowerCase())
      );
      this.filtered = filtered.filter(
        (language) => !this.value.includes(language)
      );
    },
  },
};
</script>