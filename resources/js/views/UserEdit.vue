<template>
  <section>
    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
      <b-field grouped>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('firstname') }"
          :message="form.errors.get('firstname')"
          label="Firstname"
        >
          <b-input required v-model="form.firstname"></b-input>
        </b-field>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('lastname') }"
          :message="form.errors.get('lastname')"
          label="Lastname"
        >
          <b-input required v-model="form.lastname"></b-input>
        </b-field>
      </b-field>

      <b-field
        expanded
        :type="{ 'is-danger': form.errors.has('email') }"
        :message="form.errors.get('email')"
        label="E-Mail"
      >
        <b-input required v-model="form.email"></b-input>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('languages') }"
        :message="form.errors.get('languages')"
        label="Languages"
      >
        <language-picker v-model="form.languages"></language-picker>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('location') }"
        :message="form.errors.get('location')"
        label="City (closest)"
      >
        <location-picker v-model="form.location"></location-picker>
      </b-field>

      <button :disabled="form.busy" type="submit" class="button is-success">Save</button>
      <b-loading :is-full-page="false" :active.sync="isWorking || form.busy"></b-loading>
    </form>
  </section>
</template>

<script>
import Form from "vform";

export default {
  props: ["userId"],

  data() {
    return {
      form: new Form({
        firstname: "",
        lastname: ""
      }),
      user: null,
      isWorking: true
    };
  },

  mounted() {
    this.load(this.userId);
  },

  methods: {
    save() {
      this.form
        .post(`/api/user/${this.userId}`)
        .then(data => {
          console.log(data);
        })
        .catch(error => {
          this.$notification.open({
            duration: 5000,
            message: `Could not save user: ${error.message}`,
            type: "is-danger",
            hasIcon: true
          });
        });
    },
    load(id) {
      this.isWorking = true;
      axios
        .get(`/api/user/${id}`)
        .then(data => {
          let user = data.data;
          this.user = user;
          this.form.firstname = user.firstname;
          this.form.lastname = user.lastname;
          this.form.email = user.email;
          this.form.languages = user.languages;
          this.form.location = user.location;
        })
        .catch(error => {
          this.$notification.open({
            duration: 5000,
            message: `Could not fetch user: ${error.message}`,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isWorking = false;
        });
    }
  }
};
</script>