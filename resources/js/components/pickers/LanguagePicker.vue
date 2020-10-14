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
      this.filtered = this.languages.filter((language) => {
        return language.name.toLowerCase().includes(text.toLowerCase());
      });
    },
  },
};
</script>