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

      <b-field
        :type="{ 'is-danger': form.errors.has('university') }"
        :message="form.errors.get('university')"
        label="University"
      >
        <university-picker v-model="form.university"></university-picker>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('timezone_id') }"
        :message="form.errors.get('timezone_id')"
        label="Display dates in this timezone"
      >
        <timezone-picker v-model="form.timezone_id"></timezone-picker>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('degree_id') }"
        :message="form.errors.get('degree_id')"
        label="Degree program"
      >
        <degree-select v-model="form.degree_id"></degree-select>
      </b-field>

      <b-field grouped>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('past_conferences') }"
          :message="form.errors.get('past_conferences')"
          label="Past conferences you have attended"
        >
          <b-input v-model="form.past_conferences"></b-input>
        </b-field>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('past_conferences_sv') }"
          :message="form.errors.get('past_conferences_sv')"
          label="Past conferences you have attended as SV"
        >
          <b-input v-model="form.past_conferences_sv"></b-input>
        </b-field>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('shirt_id') }"
        :message="form.errors.get('shirt_id')"
        label="T-Shirt"
      >
        <shirt-select v-model="form.shirt_id"></shirt-select>
      </b-field>

      <b-field label="Password" :message="form.errors.get('password')">
        <b-field grouped :type="{ 'is-danger': form.errors.has('password') }">
          <b-input
            expanded
            type="password"
            v-model="form.password"
            password-reveal
            placeholder="Your password"
            required
          ></b-input>

          <b-input
            expanded
            type="password"
            v-model="form.password_confirmation"
            password-reveal
            placeholder="Confirm your password"
            required
          ></b-input>
        </b-field>
      </b-field>

      <button :disabled="form.busy" type="submit" class="button is-primary is-pulled-right">Sign up</button>
    </form>

    <b-loading animation :is-full-page="true" :active.sync="form.busy"></b-loading>

    <b-modal :can-cancel="false" :active.sync="registerSuccess">
      <div class="box">
        <b-message type="is-success" has-icon>
          <h1 class="title">Welcome on board!</h1>
          <h2 class="subtitle">You can now see all conferences and enroll. Happy SV-ing!</h2>
        </b-message>
        <b-button
          class="is-pulled-right"
          type="is-success"
          size="is-large"
          @click="goTo('/home')"
        >Next</b-button>
      </div>
    </b-modal>
  </section>
</template>

<script>
import Form from "vform";

export default {
  data() {
    return {
      form: new Form({
        firstname: "",
        lastname: "",
        email: "",
        languages: [],
        degree_id: null,
        past_conferences: "",
        past_conferences_sv: "",
        shirt_id: null,
        location: {},
        university: {},
        timezone_id: null,
        password: "",
        password_confirmation: ""
      }),
      registerSuccess: false
    };
  },

  methods: {
    save() {
      this.form
        .post(`register`)
        .then(data => {
          this.registerSuccess = true;
        })
        .catch(error => {
          this.$toast.open({
            duration: 5000,
            message: `Could not save user: ${error.message}`,
            type: "is-danger"
          });
        });
    }
  }
};
</script>