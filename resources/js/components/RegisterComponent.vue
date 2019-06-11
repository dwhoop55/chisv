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

          <b-field label="Email" type="is-danger" message="This email is invalid">
            <b-input type="email" value="john@" maxlength="30"></b-input>
          </b-field>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["title"],
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
