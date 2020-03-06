<template>
  <b-tag rounded :size="size" :type="type">
    <b-tooltip :type="type" :label="tooltip" multilined>{{ name | capitalize }}</b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["state", "size"],

  computed: {
    type: function() {
      if (this.state) {
        return this.stateType(this.state);
      } else {
        return "is-white";
      }
    },
    tooltip() {
      if (this.state) {
        return this.state.description;
      } else {
        return "Currently in an unknown state";
      }
    },
    name() {
      if (this.state) {
        return this.state.name;
      } else {
        return "unknown";
      }
    }
  }
};
</script>
