<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Privacy Policy</p>
    </header>
    <section class="modal-card-body">
      <privacy-policy-content />
    </section>
    <footer class="modal-card-foot">
      <button class="button is-primary" type="button" @click="$parent.close()">Ok</button>
    </footer>
  </div>
</template>

<script>
export default {
  created() {
    const unregisterRouterGuard = this.$router.beforeEach((to, from, next) => {
      this.$parent.close();
      next(false);
    });

    this.$once("hook:destroyed", () => {
      unregisterRouterGuard();
    });
  }
};
</script>
