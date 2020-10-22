<template>
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
      let textMatches = this.languages.filter((l) =>
        l.name.toLowerCase().includes(text.toLowerCase())
      );

      this.filtered = textMatches.filter((language) => {
        let existingLanguageIds = this.value.map((language) => language.id);
        return !existingLanguageIds.includes(language.id);
      });
    },
  },
};
</script>