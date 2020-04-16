<template></template>

<script>
export default {
  created() {
    // We get here if no conference could be matched
    this.$buefy.notification.open({
      duration: 10000,
      message: `${this.$route.path} was not found`,
      type: "is-warning",
      hasIcon: true
    });
    this.$router.replace({ name: "conferences" });
  }
};
</script>