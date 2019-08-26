<template>
  <b-tag rounded :size="size" :type="type">
    <b-tooltip :type="type" :label="state.description" multilined>{{ state.name | capitalize }}</b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["state", "size"],

  computed: {
    type: function() {
      return this.stateType(this.state);
    }
  }
};
</script>
