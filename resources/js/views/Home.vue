<template>
  <section class="hero">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">Hi {{ firstname }}</h1>
        <h2 class="subtitle">You are logged in!</h2>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  computed: {
    firstname: function() {
      return this.$store.state.user.firstname;
    }
  }
};
</script>
