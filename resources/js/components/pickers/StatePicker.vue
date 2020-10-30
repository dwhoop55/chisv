<template>
  <b-dropdown
    @change="$emit('change', $event)"
    @active-change="$emit('active-change', $event)"
    :value="getValue"
    aria-role="list"
    :multiple="multiple"
    :inline="inline"
    :disabled="disabled"
  >
    <button class="button" type="button" slot="trigger">
      <!-- Multiple -->
      <span v-if="multiple && getValue.length >= 1"
        >States {{ value.length }}/{{ allStates.length }}</span
      >
      <span v-else-if="multiple && getValue.length == 0 && text">{{
        text
      }}</span>
      <span v-else-if="multiple && getValue.length == 0">Select states</span>
      <!-- Single -->
      <span v-else-if="!multiple && getValue.name">{{
        value.name | capitalize
      }}</span>
      <span v-else-if="!multiple && !getValue && text">{{ text }}</span>
      <span v-else-if="!multiple && !getValue">Select state</span>
      <b-icon icon="menu-down"></b-icon>
    </button>
    <b-dropdown-item
      v-for="state in allStates"
      :value="state"
      :key="state.id"
      aria-role="listitem"
    >
      <span :class="stateType(state).replace('is-', 'has-text-')">{{
        state.name | capitalize
      }}</span>
      <span v-if="!hideDescription">({{ state.description }})</span>
    </b-dropdown-item>
  </b-dropdown>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: [
    "value",
    "forType",
    "disabled",
    "multiple",
    "hideDescription",
    "text",
    "inline",
  ],

  data() {
    return {
      isLoading: false,
    };
  },

  created() {
    if (!this.states) {
      this.isLoading = true;
      this.fetchStates().then((this.isLoading = false));
    }
  },

  computed: {
    getValue() {
      if (this.value) {
        return this.value;
      } else {
        return this.multiple ? [] : {};
      }
    },
    allStates() {
      if (this.forType) {
        return this.statesFor(`App\\${this.forType}`);
      } else {
        return this.states;
      }
    },
    ...mapGetters("defines", ["statesFor", "states"]),
  },

  methods: mapActions("defines", ["fetchStates"]),
};
</script>