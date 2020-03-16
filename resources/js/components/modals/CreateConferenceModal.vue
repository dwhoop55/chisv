<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">Create new conference</p>
    </header>
    <div class="card-content">
      <p class="has-padding-5">
        This conference will be in state
        <strong>planning</strong> after creation
      </p>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <b-field
          label="Name"
          :type="{ 'is-danger': form.errors.has('name') }"
          :message="form.errors.get('name')"
        >
          <b-input v-model="form.name"></b-input>
        </b-field>

        <b-field
          label="Key (https://chisv.org/conference/key)"
          :type="{ 'is-danger': form.errors.has('key') }"
          :message="form.errors.get('key')"
        >
          <b-input v-model="form.key"></b-input>
        </b-field>

        <b-field grouped position="is-right">
          <button :disabled="form.busy" type="submit" class="button is-success">Next</button>
        </b-field>
      </form>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  data() {
    return {
      form: new Form({
        name: null,
        key: "e.g. chi19, autoui2019"
      })
    };
  },

  created() {
    const unregisterRouterGuard = this.$router.beforeEach((to, from, next) => {
      this.$parent.close();
      next(false);
    });

    this.$once("hook:destroyed", () => {
      unregisterRouterGuard();
    });
  },

  methods: {
    create: function() {
      api
        .createConference(this.form)
        .then(data => {
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success",
            queue: false
          });
          this.$emit("created", this.form.key);
          this.$parent.close();
        })
        .catch(error => {
          if (error.response.status != 422) {
            this.$buefy.notification.open({
              indefinite: true,
              hasIcon: true,
              message: error.response.data.message,
              type: "is-danger"
            });
          }
        });
    }
  }
};
</script>