// v-model safe
<template>
  <section>
    <b-select
      placeholder="Select a timezone"
      :loading="fetching"
      :value="value"
      @input="$emit('input', $event)"
    >
      <option v-for="option in timezones" :value="option.id" :key="option.id">{{ option.name }}</option>
    </b-select>
  </section>
</template>

<script>
export default {
  props: ["value"],

  data() {
    return {
      timezones: [],
      fetching: true
    };
  },

  mounted() {
    axios
      .get("/api/timezone")
      .then(data => {
        this.timezones = data.data.data;
        this.fetching = false;
      })
      .catch(error => {
        this.$notification.open(`Could not load timezone: ${error}`);
      });
  }
};
</script>
