<template>
  <b-field>
    <b-radio-button
      @click.native="click(0)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-danger"
      :native-value="parseInt(0)"
    >{{ preferenceString(0) }}</b-radio-button>
    <b-radio-button
      @click.native="click(1)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-info"
      :native-value="parseInt(1)"
    >{{ preferenceString(1) }}</b-radio-button>
    <b-radio-button
      @click.native="click(2)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-warning"
      :native-value="parseInt(2)"
    >{{ preferenceString(2) }}</b-radio-button>
    <b-radio-button
      @click.native="click(3)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-success"
      :native-value="parseInt(3)"
    >{{ preferenceString(3) }}</b-radio-button>
  </b-field>
</template>

<script>
export default {
  props: ["value", "disabled", "size"],

  methods: {
    click(preference) {
      if (this.value == preference) {
        this.$emit("input", null);
      } else {
        this.$emit("input", preference);
      }
    }
  }
};
</script>