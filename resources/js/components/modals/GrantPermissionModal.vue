<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">Grant permission for {{ name }}</p>
    </header>
    <div class="card-content">
      <form @submit.prevent="grant" @keydown="form.onKeydown($event)">
        <b-field
          label="Role"
          :type="{ 'is-danger': form.errors.has('role_id') }"
          :message="form.errors.get('role_id')"
        >
          <role-picker v-model="form.role_id"></role-picker>
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
          <!-- Assigning min-id will only show states for the sv -->
          <state-picker :range="[10,20]" v-model="form.state_id"></state-picker>
        </b-field>
        <b-field grouped position="is-right">
          <button :disabled="form.busy" type="submit" class="button is-success">Grant</button>
        </b-field>
      </form>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  props: ["user"],

  data() {
    return {
      form: new Form({
        user_id: this.user.id,
        role_id: null,
        conference_id: null,
        state_id: null
      })
    };
  },

  methods: {
    grant: function() {
      api
        .grantPermission(this.form)
        .then(data => {
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success",
            queue: false
          });
          this.$emit("granted", this.form);
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
  },

  computed: {
    name: function() {
      return this.user.firstname + " " + this.user.lastname;
    }
  }
};
</script>