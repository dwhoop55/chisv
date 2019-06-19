<template>
  <section>
    <div class="form-container">
      <div class="form-card">
        <div class="form-title">
          <h1>Sign up</h1>
        </div>

        <div class="form-content">
          <b-field grouped>
            <b-field label="Firstname" expanded>
              <b-input icon="account" v-model="firstname" value></b-input>
            </b-field>

            <b-field label="Lastname" expanded>
              <b-input icon="account" v-model="lastname" value></b-input>
            </b-field>
          </b-field>

          <b-field label="Email" :message="emailMessage" :type="{ 'is-danger' : emailMessage }">
            <b-input @blur="emailBlur" icon="at" type="email" v-model="email" maxlength="64"></b-input>
          </b-field>

          <language-picker :url="'/api/language/search/'" @changed="languages = $event"></language-picker>
          <pre>{{ languages }}</pre>

          <autocomplete-fetched
            :type="'city'"
            :field="'city.name'"
            :url="'/api/city/search/'"
            :title="'City of residence'"
            :placeholder="'e.g. Berlin'"
            :notFoundText="'No results found. Try a city close by.'"
            :tooltip="'Choose the city closest to you when yours isn\'t in the list'"
            @selected="location = $event"
          ></autocomplete-fetched>
          <pre>{{ location }}</pre>

          <autocomplete-fetched
            :type="'university'"
            :field="'name'"
            :url="'/api/university/search/'"
            :title="'University'"
            :placeholder="'e.g. RWTH'"
            :notFoundText="'No results found. Type your choice'"
            :tooltip="'If your university isn\'t in the list just type it in'"
            @selected="university = $event"
          ></autocomplete-fetched>
          <pre>{{ university }}</pre>

          <b-field>&nbsp;</b-field>

          <b-field grouped position="is-right">
            <b-button @click="submitForm" type="is-primary">Sign Up</b-button>
          </b-field>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "register",
  data() {
    return {
      firstname: "",
      lastname: "",
      email: "",
      emailChecking: false,
      emailMessage: "",
      location: null,
      university: null,
      languages: null,
      errors: []
    };
  },
  mounted() {},
  methods: {
    submitForm: function() {
      if (checkForm) {
        //
      } else {
        //
      }
    },

    checkForm: function(e) {
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
      this.$http
        .get(`/api/email/exists/${this.email}`)
        .then(({ data }) => {
          if (data.result == true) {
            this.emailMessage =
              "Address is in use, try resetting your password";
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
