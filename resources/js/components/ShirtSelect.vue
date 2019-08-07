// v-model safe
<template>
  <b-select
    required
    :loading="fetching"
    :value="value"
    placeholder="Select your cut and size"
    icon="tshirt-crew"
    @input="input"
  >
    <option
      v-for="shirt in shirts"
      :value="shirt.id"
      :key="shirt.id"
    >{{ shirt.cut }} cut, size {{ shirt.size }}</option>
  </b-select>
</template>

<script>
export default {
  props: ["value"],

  data() {
    return {
      fetching: true,
      shirts: []
    };
  },

  methods: {
    input: function(event) {
      if (Number.isInteger(event)) {
        this.$emit("input", event);
      }
    }
  },

  mounted() {
    axios
      .get(`shirt`)
      .then(({ data }) => {
        this.shirts = [];
        data.data.forEach(entry => this.shirts.push(entry));
      })
      .catch(error => {
        this.shirts = [];
        throw error;
      })
      .finally(() => {
        this.fetching = false;
      });
  }
};
</script>
