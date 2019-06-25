<template>
  <b-field horizontal label="Your T‑Shirt size">
    <b-select
      @input="$emit('update:id', $event)"
      placeholder="Choose.."
      icon="tshirt-crew"
      required
    >
      <option
        v-for="shirt in shirts"
        :value="shirt.id"
        :key="shirt.id"
      >{{ shirt.cut }} cut, size {{ shirt.size }}</option>
    </b-select>
  </b-field>
</template>

<script>
export default {
  name: "shirt-select",
  props: ["url"],
  data() {
    return {
      shirts: null
    };
    x;
  },
  mounted() {
    this.$http
      .get(this.url)
      .then(({ data }) => {
        this.shirts = [];
        data.data.forEach(entry => this.shirts.push(entry));
      })
      .catch(error => {
        this.shirts = [];
        throw error;
      });
  }
};
</script>
