<template>
  <b-field horizontal label="Degree program">
    <b-select
      required
      :value="id"
      @input="$emit('update:id', $event)"
      placeholder="Select your current degree program"
      icon="school"
    >
      <option v-for="option in degrees" :value="option.id" :key="option.id">{{ option.name }}</option>
    </b-select>
  </b-field>
</template>

<script>
export default {
  name: "degree-select",
  props: ["url", "id"],
  data() {
    return { degrees: [] };
  },
  mounted() {
    this.$http
      .get(this.url)
      .then(({ data }) => {
        this.degrees = [];
        data.data.forEach(entry => this.degrees.push(entry));
      })
      .catch(error => {
        this.degrees = [];
        throw error;
      });
  }
};
</script>
