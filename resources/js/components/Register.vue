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
              <b-input v-model="firstname" value></b-input>
            </b-field>

            <b-field label="Lastname" expanded>
              <b-input v-model="lastname" value></b-input>
            </b-field>
          </b-field>

          <b-field label="Email" :type="{ 'is-danger': emailMessage }" :message="emailMessage">
            <b-input type="email" v-model="email" maxlength="64"></b-input>
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
            @selected="university = $event"
          ></autocomplete-fetched>
          <pre>{{ university }}</pre>
          <b-field>&nbsp;</b-field>

          <b-field grouped position="is-right">
            <b-button type="is-primary">Sign Up</b-button>
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
      emailMessage: "",
      email: "",
      location: null,
      university: null,
      languages: null
    };
  },
  mounted() {},
  methods: {}
};
</script>
