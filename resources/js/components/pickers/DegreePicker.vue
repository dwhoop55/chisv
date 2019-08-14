// v-model safe
<template>
  <b-select
    required
    :loading="fetching"
    :value="value"
    placeholder="Select your current degree program"
    icon="school"
    @input="input"
  >
    <option v-for="option in degrees" :value="option.id" :key="option.id">{{ option.name }}</option>
  </b-select>
</template>

<script>
export default {
  props: ["value"],

  model: {},
  data() {
    return {
      fetching: true,
      degrees: []
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
      .get(`degree`)
      .then(({ data }) => {
        this.degrees = [];
        data.data.forEach(entry => this.degrees.push(entry));
      })
      .catch(error => {
        this.degrees = [];
        throw error;
      })
      .finally(() => {
        this.fetching = false;
      });
  }
};
</script>
