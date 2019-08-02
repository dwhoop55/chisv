<template>
  <section>
    <b-field label="Password">
      <b-input
        type="password"
        :value="password"
        password-reveal
        placeholder="Your password"
        required
      ></b-input>
    </b-field>

    <b-field label="Confirm Password">
      <b-input
        type="password"
        :value="password_confirm"
        password-reveal
        placeholder="Confirm your password"
        required
      ></b-input>
    </b-field>
  </section>
</template>

<script>
export default {
  props: ["userId"],

  data() {
    return {
      password: "",
      password_confirm: ""
    };
  }
};
</script>