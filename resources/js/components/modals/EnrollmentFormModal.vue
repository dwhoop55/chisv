<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Submitted enrollment information</p>
    </header>
    <section class="modal-card-body">
      <b-loading :is-full-page="false" :active="isLoading" />
      <enrollment-form :disabled="!canEdit" v-model="form"></enrollment-form>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-primary" type="button" @click="$parent.close()">Close</button>
      <button v-if="canEdit" class="button is-success" type="button" @click="save()">Apply changes</button>
    </footer>
  </div>
</template>

<script>
import api from "@/api";
import { mapActions } from "vuex";
export default {
  props: ["form", "canEdit", "onUpdated"],

  data() {
    return {
      isLoading: false,
      unregisterRouterGuard: null
    };
  },

  created() {
    this.unregisterRouterGuard = this.$router.beforeEach((to, from, next) => {
      this.$parent.close();
      next(false);
    });

    this.$once("hook:destroyed", () => {
      this.unregisterRouterGuard();
    });
  },

  methods: {
    save() {
      this.isLoading = true;
      api
        .updateEnrollmentForm(this.form.id, this.form.vform)
        .then(({ data }) => {
          this.$buefy.toast.open({
            message: "Changes saved!",
            type: "is-success"
          });
          this.unregisterRouterGuard();
          this.$parent.close();
          this.fetchUser();
          if (this.onUpdated) {
            this.onUpdated();
          }
        })
        .catch(error => {
          console.log(error.code);
          this.$buefy.toast.open({
            message:
              error.response?.status == 403
                ? "Conference no longer allows for changes"
                : error,
            type: "is-danger"
          });
        })
        .finally(() => (this.isLoading = false));
    },
    ...mapActions("auth", ["fetchUser"])
  }
};
</script>
