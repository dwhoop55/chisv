<template>
  <div>
    <b-tooltip
      v-for="(bid, index) in bids"
      :key="`fruit-${index}`"
      :type="type(index)"
      :label="index | capitalize"
      :class="$style.bid-counter-item"
    >
      <span :class="type(index).replace('is-' ,'has-text-')">{{ bid }}</span>
    </b-tooltip>
  </div>
</template>

<script>
export default {
  props: ["bids"],

  methods: {
    type(string) {
      return this.preferenceType(this.stringToPreference(string));
    }
  }
};
</script>

<style module>
.bid-counter-item {
  margin-left: 0.2em;
  margin-right: 0.2em;
}
</style>
