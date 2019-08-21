<template>
  <div class="card">
    <header class="card-header">
      <p class="card-header-title">Edit permission</p>
    </header>
    <div class="card-content">
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <b-field
          label="Role"
          :type="{ 'is-danger': form.errors.has('role_id') }"
          :message="form.errors.get('role_id')"
        >
          <role-picker v-model="form.role_id"></role-picker>
        </b-field>
        <b-field
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
          <button :disabled="form.busy" type="submit" class="button is-success">Save</button>
        </b-field>
      </form>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  props: ["permission"],

  data() {
    return {
      form: new Form({
        id: this.permission.id,
        role_id: this.permission.role_id,
        conference_id: this.permission.conference_id,
        state_id: this.permission.state_id
      })
    };
  },

  methods: {
    update: function() {
      api
        .updatePermission(this.form, this.permission.id)
        .then(data => {
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success"
          });
          this.$emit("updated");
          this.$parent.close();
        })
        .catch(error => {
          this.$buefy.notification.open({
            queue: false,
            indefinite: true,
            hasIcon: true,
            message: error.response.data.message,
            type: "is-danger"
          });
        });
    }
  }
};
</script>