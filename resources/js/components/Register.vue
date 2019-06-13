<template>
  <section>
    <div class="form-container">
      <div class="form-card">
        <div class="form-title">
          <h1>{{ title }}</h1>
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

          <b-field>
            <b-select v-model="country" placeholder="Country" icon="earth">
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
            </b-select>
          </b-field>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["title"],
  data() {
    return {
      firstname: "",
      lastname: "",
      emailMessage: "",
      email: "",
      country: ""
    };
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
