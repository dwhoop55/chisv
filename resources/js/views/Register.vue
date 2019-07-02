<template>
  <div class="columns is-centered">
    <div class="column is-three-quarters">
      <div class="form-card">
        <div class="form-title">
          <h1>Sign up</h1>
        </div>
        <div class="form-content">
          <form @submit.prevent="formSubmit($data)">
            <section class="section">
              <b-field horizontal label="Name">
                <b-input
                  icon="account"
                  placeholder="Firstname"
                  v-model="firstname"
                  value
                  expanded
                  required
                ></b-input>
                <b-input
                  icon="account"
                  placeholder="Lastname"
                  v-model="lastname"
                  value
                  expanded
                  required
                ></b-input>
              </b-field>

              <b-field
                horizontal
                label="Email"
                :message="emailMessage"
                :type="{ 'is-danger' : emailMessage }"
              >
                <b-input
                  @blur="emailBlur"
                  icon="at"
                  type="email"
                  v-model="email"
                  maxlength="64"
                  required
                ></b-input>
              </b-field>

              <language-picker :url="'/api/language/search/'" @update:tags="languages = $event"></language-picker>
              <!-- <pre>{{ languages }}</pre> -->
            </section>

            <section class="section">
              <autocomplete-fetched
                :id.sync="location"
                :type="'city'"
                :field="'city.name'"
                :url="'/api/city/search/'"
                :title="'City of residence'"
                :placeholder="'e.g. Berlin'"
                :notFoundText="'No results found. Try a city close by.'"
                :tooltip="'Choose the city closest to you when yours isn\'t in the list'"
              ></autocomplete-fetched>
              <!-- <pre>{{ location }}</pre> -->

              <autocomplete-fetched
                :id.sync="university"
                :value.sync="universityString"
                :type="'university'"
                :field="'name'"
                :url="'/api/university/search/'"
                :title="'University'"
                :placeholder="'e.g. RWTH'"
                :notFoundText="'No results found. Type your choice'"
                :tooltip="'If your university isn\'t in the list just type it in'"
              ></autocomplete-fetched>
              <!-- <pre>{{ university }}</pre> -->

              <degree-select :id.sync="degreeId" :url="'/api/degree'"></degree-select>
              <!-- <pre>{{ degreeId }}</pre> -->
            </section>

            <section class="section">
              <b-field horizontal label="Past conferences you have attended">
                <b-input v-model="pastConferences" maxlength="255" icon="pencil"></b-input>
              </b-field>

              <b-field horizontal label="Past conferences you have attended as SV">
                <b-input v-model="pastConferencesSV" maxlength="255" icon="pencil"></b-input>
              </b-field>

              <shirt-select :id.sync="shirtId" :url="'/api/shirt'"></shirt-select>
              <!-- <pre>{{ shirtId }}</pre> -->
            </section>

            <section class="section">
              <b-field horizontal label="Password">
                <b-input
                  v-model="password1"
                  type="password"
                  minlength="6"
                  placeholder="Password for your account"
                  required
                ></b-input>
              </b-field>

              <b-field horizontal label="Confirm">
                <b-input
                  v-model="password2"
                  type="password"
                  minlength="6"
                  placeholder="Confirm your password"
                  required
                ></b-input>
              </b-field>
            </section>

            <b-field grouped position="is-right">
              <b-button
                v-bind:class="{ 'is-loading': isSubmitting }"
                class="is-primary"
                tag="input"
                native-type="submit"
                value="Sign Up"
              />
            </b-field>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { log } from "util";
export default {
  name: "Register",
  data() {
    return {
      isSubmitting: false,
      firstname: "",
      lastname: "",
      email: "",
      emailChecking: false,
      emailMessage: "",
      location: null,
      university: null,
      universityString: "",
      languages: null,
      degreeId: null,
      pastConferences: "",
      pastConferencesSV: "",
      shirtId: null,
      password1: "",
      password2: "",
      errors: []
    };
  },
  mounted() {},
  methods: {
    formSubmit: function() {
      if (this.checkForm) {
        let payload = {
          firstname: this.firstname.trim(),
          lastname: this.lastname.trim(),
          email: this.email,
          cityId: this.location ? this.location.city.id : undefined,
          universityId: this.university ? this.university.id : undefined,
          universityString: this.universityString.trim(),
          languageIds: this.languages
            ? this.languages.map(a => a.id)
            : undefined,
          degreeId: this.degreeId,
          pastConferences: this.pastConferences.trim(),
          pastConferencesSV: this.pastConferencesSV.trim(),
          shirtId: this.shirtId,
          password: this.password1,
          password_confirmation: this.password2
        };

        this.isSubmitting = true;
        axios
          .post("/register", payload)
          .then(function(response) {
            if (response.status == 201) {
            }
          })
          .catch(
            function(error) {
              if (error.response.status == 422) {
                this.$toast.open({
                  duration: 5000,
                  message: `${error.response.data.message} (${error.response.status})`,
                  type: "is-danger"
                });
              } else {
                this.$toast.open({
                  duration: 5000,
                  message: `The request failed. Please try again (${error.response.status})`,
                  type: "is-danger"
                });
              }
            }.bind(this)
          )
          .finally((this.isSubmitting = false));
      } else {
        //
      }
    },

    toTitleCase: function(str) {
      return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
      });
    },

    checkForm: function() {
      this.errors = [];

      if (!this.firstname) {
        this.errors.push("Firstname required");
      }
      if (!this.lastname) {
        this.errors.push("Lastname required");
      }
      if (!this.email) {
        this.errors.push("Email required");
      } else if (!this.validEmail(this.email)) {
        this.errors.push("Valid email required.");
      }

      if (!this.errors.length) {
        return true;
      }
    },

    validEmail: function(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },

    emailBlur: function() {
      // Valid email-like string
      if (!this.email || this.email < 2) {
        return;
      }
      this.emailChecking = true;
      axios
        .get(`/api/email/exists/${this.email}`)
        .then(({ data }) => {
          if (data.result == true) {
            this.emailMessage =
              "Looks like you already have an account with this email address, try resetting your password";
          } else {
            this.emailMessage = "";
          }
        })
        .catch(error => {
          throw error;
        })
        .finally(() => {
          this.emailChecking = false;
        });
    }
  }
};
</script>
