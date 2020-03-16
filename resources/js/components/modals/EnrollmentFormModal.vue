<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Submitted enrollment information</p>
    </header>
    <section class="modal-card-body">
      <enrollment-form v-model="value" :disabled="true"></enrollment-form>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-primary" type="button" @click="$parent.close()">Close</button>
    </footer>
  </div>
</template>

<script>
export default {
  props: ["value"],

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
