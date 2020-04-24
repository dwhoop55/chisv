<template>
  <b-field>
    <b-radio-button
      @input="click"
      @click.native="click(0)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-danger"
      :native-value="parseInt(0)"
    >
      <div class="is-hidden-desktop">X</div>
      <div class="is-hidden-touch">{{ preferenceString(0) }}</div>
    </b-radio-button>
    <b-radio-button
      @input="click"
      @click.native="click(1)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-info"
      :native-value="parseInt(1)"
    >{{ preferenceString(1) }}</b-radio-button>
    <b-radio-button
      @input="click"
      @click.native="click(2)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-warning"
      :native-value="parseInt(2)"
    >
      <div class="is-hidden-desktop">{{ preferenceString(2).substr(0,3) }}</div>
      <div class="is-hidden-touch">{{ preferenceString(2) }}</div>
    </b-radio-button>
    <b-radio-button
      @input="click"
      @click.native="click(3)"
      :value="value"
      :disabled="disabled"
      :size="size"
      type="is-success"
      :native-value="parseInt(3)"
    >{{ preferenceString(3) }}</b-radio-button>
    <b-button
      @click="$emit('click-help')"
      type="is-text"
      class="is-paddingless"
      v-if="showHelp"
      size="is-small"
    >
      <b-icon class="is-marginless" size="is-small" icon="help"></b-icon>
    </b-button>
  </b-field>
</template>

<script>
export default {
  props: ["value", "disabled", "size", "showHelp"],

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