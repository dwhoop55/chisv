// v-model safe
<template>
  <b-select
    expanded
    required
    :loading="isLoading"
    :value="value"
    placeholder="Select your current degree program"
    icon="school"
    @input="$emit('input', $event)"
  >
    <option v-for="option in degrees" :value="option.id" :key="option.id">
      {{ option.name }}
    </option>
  </b-select>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["value"],

  model: {},
  data() {
    return {
      isLoading: false,
    };
  },

  computed: mapGetters("defines", ["degrees"]),
  methods: mapActions("defines", ["fetchDegrees"]),
};
</script>
