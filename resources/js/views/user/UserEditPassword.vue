<template>
  <form @submit.prevent="save" @keydown="form.onKeydown($event)">
    <b-field label="Password">
      <b-input
        type="password"
        v-model="form.password"
        password-reveal
        placeholder="Your password"
        required
      ></b-input>
    </b-field>

    <b-field
      label="Confirm Password"
      :type="{ 'is-danger': form.errors.has('password') }"
      :message="form.errors.get('password')"
    >
      <b-input
        type="password"
        v-model="form.password_confirmation"
        password-reveal
        placeholder="Confirm your password"
        required
      ></b-input>
    </b-field>

    <button
      :disabled="form.busy"
      type="submit"
      class="button is-success is-pulled-right"
    >Set new password</button>
  </form>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  props: ["user"],
  model: {
    prop: "user"
  },
  data() {
    return {
      form: new Form({
        id: null,
        password: "",
        password_confirmation: ""
      })
    };
  },

  methods: {
    save() {
      api
        .updateUser(this.user.id, this.form)
        .then(data => {
          this.user = data.data.result;
          this.$buefy.toast.open({
            message: "Changes saved!",
            type: "is-success"
          });
        })
        .finally(() => this.$emit("input", this.user));
    }
  }
};
</script>
