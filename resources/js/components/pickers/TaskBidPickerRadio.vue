<template>
  <b-field class>
    <b-button
      :class="btnClass"
      :outlined="value !== 0"
      @click="click(0)"
      :size="size"
      :type="{ 'is-danger' : value === 0}"
      :disabled="disabled"
    >
      <div class="is-hidden-desktop">X</div>
      <div class="is-hidden-touch">{{ preferenceString(0) }}</div>
    </b-button>
    <b-button
      :class="btnClass"
      :outlined="value !== 1"
      @click="click(1)"
      :size="size"
      :type="{ 'is-info' : value === 1}"
      :disabled="disabled"
    >{{ preferenceString(1) }}</b-button>
    <b-button
      :class="btnClass"
      :outlined="value !== 2"
      @click="click(2)"
      :size="size"
      :type="{ 'is-warning' : value === 2}"
      :disabled="disabled"
    >
      <div class="is-hidden-desktop">{{ preferenceString(2).substr(0,3) }}</div>
      <div class="is-hidden-touch">{{ preferenceString(2) }}</div>
    </b-button>
    <b-button
      :class="btnClass"
      :outlined="value !== 3"
      @click="click(3)"
      :size="size"
      :type="{ 'is-success' : value === 3}"
      :disabled="disabled"
    >{{ preferenceString(3) }}</b-button>

    <b-button
      @click="$emit('click-help')"
      type="is-text"
      class="control is-paddingless"
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

  computed: {
    btnClass() {
      return `control is-radiusless`;
    }
  },

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