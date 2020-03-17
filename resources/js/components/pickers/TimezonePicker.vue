<template>
  <section>
    <b-select
      expanded
      placeholder="Select a timezone"
      :loading="isLoading"
      :value="value"
      @input="input"
    >
      <option v-for="option in timezones" :value="option.id" :key="option.id">{{ option.name }}</option>
    </b-select>
  </section>
</template>

<script>
import api from "@/api";

export default {
  props: ["value"],

  data() {
    return {
      timezones: [],
      isLoading: true
    };
  },

  methods: {
    input: function(event) {
      if (Number.isInteger(event)) {
        this.$emit("input", event);
        this.emitObject(event);
      }
    },
    emitObject: function(id) {
      this.timezones.forEach(timezone => {
        if (timezone.id == id) {
          this.$emit("timezone", timezone);
        }
      });
    }
  },

  created() {
    api
      .getTimezones()
      .then(({ data }) => (this.timezones = data))
      .finally(() => (this.isLoading = false));
  }
};
</script>
