<template>
  <b-field>
    <b-radio-button v-model="value.preference" native-value="1">1</b-radio-button>
    <b-radio-button v-model="value.preference" native-value="2">2</b-radio-button>
    <b-radio-button v-model="value.preference" native-value="3">3</b-radio-button>
    <b-radio-button v-model="value.preference" native-value="X">X</b-radio-button>
  </b-field>
</template>

<script>
export default {
  props: ["value"]
};
</script>