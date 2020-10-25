// v-model safe
<template>
  <b-select
    expanded
    required
    :loading="isLoading"
    :value="value"
    placeholder="Select your cut and size"
    icon="tshirt-crew"
    @input="$emit('input', $event)"
  >
    <option v-for="shirt in shirts" :value="shirt.id" :key="shirt.id">
      {{ shirt.cut }} cut, size {{ shirt.size }}
    </option>
  </b-select>
</template>

<script>
import api from "@/api";
import { mapGetters, mapActions } from "vuex";
export default {
  props: ["value"],

  data() {
    return {
      isLoading: false,
    };
  },

  computed: mapGetters("defines", ["shirts"]),
  methods: mapActions("defines", ["fetchShirts"]),
};
</script>
