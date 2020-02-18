<template>
  <b-field>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-danger"
      :native-value="parseInt(0)"
    >{{ preferenceToString(0) }}</b-radio-button>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-info"
      :native-value="parseInt(1)"
    >{{ preferenceToString(1) }}</b-radio-button>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-warning"
      :native-value="parseInt(2)"
    >{{ preferenceToString(2) }}</b-radio-button>
    <b-radio-button
      @input="$emit('input', $event)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-success"
      :native-value="parseInt(3)"
    >{{ preferenceToString(3) }}</b-radio-button>
  </b-field>
</template>

<script>
export default {
  props: ["value", "disabled", "size"]
};
</script>