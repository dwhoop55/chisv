<template>
  <div class="has-text-left">
    <h3>Page not found</h3>
    <b-button size="is-large" type="is-primary" @click="goHome">Home</b-button>
  </div>
</template>

<script>
export default {
  methods: {
    goHome() {
      this.$router.replace({ name: "conferences" });
    }
  }
};
</script>