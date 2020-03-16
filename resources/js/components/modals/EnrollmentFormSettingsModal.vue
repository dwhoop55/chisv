<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Enrollment form weight settings</p>
    </header>
    <section class="modal-card-body">
      <p>These weights are sent to the backend. Next, form weights get recalculated. After that the table reloads with the new values</p>
      <p>The template these values are loaded from is not changed.</p>
      <br />
      <enrollment-form-weight-settings v-model="value"></enrollment-form-weight-settings>
    </section>
    <footer class="modal-card-foot">
      <b-button type="is-danger" @click="$parent.close()">Cancel</b-button>
      <b-button type="is-success" @click="$parent.close();update(value)">Recalculate form weights</b-button>
    </footer>
  </div>
</template>

<script>
export default {
  props: ["value", "update"],

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
