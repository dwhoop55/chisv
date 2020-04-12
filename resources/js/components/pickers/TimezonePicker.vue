<template>
  <section>
    <b-select
      expanded
      placeholder="Select a timezone"
      :loading="isLoading"
      :value="value"
      @input="$emit('input', $event)"
    >
      <option v-for="option in timezones" :value="option.id" :key="option.id">{{ option.name }}</option>
    </b-select>
  </section>
</template>

<script>
import api from "@/api";
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["value"],

  data() {
    return {
      isLoading: false
    };
  },

  created() {
    if (!this.timezones) {
      this.isLoading = true;
      this.fetchTimezones().then(() => (this.isLoading = false));
    }
  },

  computed: mapGetters("defines", ["timezones"]),
  methods: mapActions("defines", ["fetchTimezones"])
};
</script>
