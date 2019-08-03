<template>
  <section>
    <b-tabs expanded :animated="false" v-model="activeTab">
      <b-tab-item icon="account" label="Profile">
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
            <location-picker :for="country" v-model="form.location"></location-picker>
          </b-field>

          <b-field
            :type="{ 'is-danger': form.errors.has('university') }"
            :message="form.errors.get('university')"
            label="University"
          >
            <university-picker v-model="form.university"></university-picker>
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
              <b-input required v-model="form.past_conferences"></b-input>
            </b-field>
            <b-field
              expanded
              :type="{ 'is-danger': form.errors.has('past_conferences_sv') }"
              :message="form.errors.get('past_conferences_sv')"
              label="Past conferences you have attended as SV"
            >
              <b-input required v-model="form.past_conferences_sv"></b-input>
            </b-field>
          </b-field>

          <b-field
            :type="{ 'is-danger': form.errors.has('shirt_id') }"
            :message="form.errors.get('shirt_id')"
            label="T-Shirt"
          >
            <shirt-select v-model="form.shirt_id"></shirt-select>
          </b-field>

          <button
            :disabled="isWorking || form.busy"
            type="submit"
            class="button is-success is-pulled-right"
          >Save</button>
          <b-loading :is-full-page="false" :active.sync="isWorking || form.busy"></b-loading>
        </form>
      </b-tab-item>

      <b-tab-item icon="key" label="Password">
        <password-set :userId="user.id"></password-set>
      </b-tab-item>
    </b-tabs>
  </section>
</template>

<script>
import Form from "vform";

export default {
  props: ["userId"],

  data() {
    return {
      form: new Form({
        id: null,
        firstname: "",
        lastname: "",
        email: "",
        languages: [],
        location: {},
        university: {},
        degree_id: null,
        past_conferences: "",
        past_conferences_sv: "",
        shirt_id: null
      }),
      user: null,
      isWorking: true,
      activeTab: 0
    };
  },

  mounted() {
    this.load(this.userId);
  },

  methods: {
    save() {
      this.form
        .put(`/api/user/${this.userId}`)
        .then(data => {
          this.load(this.user.id);
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
          this.form.id = user.id;
          this.form.firstname = user.firstname;
          this.form.lastname = user.lastname;
          this.form.email = user.email;
          this.form.languages = user.languages;
          this.form.location = user.location;
          if (user.university) {
            this.form.university = user.university;
          } else {
            this.form.university = { name: user.university_fallback };
          }
          this.form.degree_id = user.degree_id;
          this.form.past_conferences = user.past_conferences;
          this.form.past_conferences_sv = user.past_conferences_sv;
          this.form.shirt_id = user.shirt_id;
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