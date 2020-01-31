<template>
  <b-field>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-danger"
      :native-value="parseInt(0)"
    >X</b-radio-button>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-info"
      :native-value="parseInt(1)"
    >1</b-radio-button>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-warning"
      :native-value="parseInt(2)"
    >2</b-radio-button>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-success"
      :native-value="parseInt(3)"
    >3</b-radio-button>
  </b-field>
</template>

<script>
export default {
  props: ["value", "disabled", "size"]
};
</script>