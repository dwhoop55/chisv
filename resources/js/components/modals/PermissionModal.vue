<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ this.permission ? 'Edit' : 'Grant' }} permission</p>
    </header>
    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
      <section class="modal-card-body">
        <b-field
          label="Role"
          :type="{ 'is-danger': form.errors.has('role_id') }"
          :message="form.errors.get('role_id')"
        >
          <role-picker :disabled="permission" v-model="form.role_id"></role-picker>
        </b-field>
        <b-field
          v-if="form.role_id && form.role_id!=1"
          label="Conference"
          :type="{ 'is-danger': form.errors.has('conference_id') }"
          :message="form.errors.get('conference_id')"
        >
          <conference-picker v-model="form.conference_id"></conference-picker>
        </b-field>
        <b-field
          v-if="form.role_id==10"
          label="State"
          :type="{ 'is-danger': form.errors.has('state_id') }"
          :message="form.errors.get('state_id')"
        >
          <state-picker
            :inline="true"
            forType="User"
            :value="permission ? permission.state : null"
            @change="form.state_id = $event.id"
          ></state-picker>
        </b-field>
      </section>
      <footer class="modal-card-foot">
        <button :disabled="form.busy" type="submit" class="button is-success">Save</button>
      </footer>
    </form>
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  props: {
    permission: {
      type: Object,
      default: null
    },
    user: {
      type: Object,
      default: null
    }
  },

  data() {
    return {
      form: new Form({
        user_id: this.getUserId(),
        id: this.permission ? this.permission.id : null,
        role_id: this.permission ? this.permission.role.id : null,
        conference_id:
          this.permission && this.permission.conference
            ? this.permission.conference.id
            : null,
        state_id:
          this.permission && this.permission.state
            ? this.permission.state.id
            : null
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
    save: function() {
      let promise;
      if (this.permission) {
        // Permission given, update
        promise = api.updatePermission(this.form, this.permission.id);
      } else {
        // No Permission given, create a new one
        promise = api.createPermission(this.form);
      }

      promise
        .then(data => {
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success"
          });
          this.permission ? this.$emit("updated") : this.$emit("created");
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
    },
    getUserId: function() {
      if (this.permission && this.permission.user && this.permission.user.id) {
        return this.permission.user.id;
      } else if (this.user && this.user.id) {
        return this.user.id;
      } else {
        return;
      }
    }
  }
};
</script>