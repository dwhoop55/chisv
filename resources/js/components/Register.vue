<template>
  <section>
    <div class="form-container">
      <div class="form-card">
        <div class="form-title">
          <h1>{{ title }}</h1>
        </div>

        <div class="form-content">
          <b-field label="Firstname">
            <b-input v-model="firstname" value></b-input>
          </b-field>

          <b-field label="Lastname">
            <b-input v-model="lastname" value></b-input>
          </b-field>

          <b-field label="Email" :type="{ 'is-danger': emailMessage }" :message="emailMessage">
            <b-input type="email" v-model="email" maxlength="64"></b-input>
          </b-field>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["title"],
  data: {
    firstname: "",
    lastname: "",
    emailMessage: "1",
    email: ""
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
