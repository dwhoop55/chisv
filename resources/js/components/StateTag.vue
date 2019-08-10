<template>
  <b-tag :size="size" :type="stateType">
    <b-tooltip :label="state.description" multilined>{{ state.name }}</b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["state", "size"],

  computed: {
    stateType: function() {
      switch (this.state.name) {
        case "accepted":
          return "is-success";
          break;
        case "dropped":
          return "is-danger";
          break;
        case "enrolled":
          return "is-light";
          break;
        case "waitlisted":
          return "is-warning";
          break;
      }
    }
  }
};
</script>
