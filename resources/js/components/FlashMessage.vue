<template></template>

<script>
export default {
  props: ["type", "message", "duration"],
  mounted: function() {
    this.$toast.open({
      duration: this.duration,
      indefinite: this.duration ? false : true,
      message: this.message,
      type: this.type
    });
  }
};
</script>