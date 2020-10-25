<template>
  <div class="columns is-centered">
    <div
      class="column is-12-mobile is-10-tablet is-8-desktop is-6-widescreen is-5-fullhd"
    >
      <div class="card">
        <div class="card-image"><conference-preview-carousel /></div>
        <div class="card-content">
          <p class="field">
            Sign in to
            <a target="_blank" href="https://hci.rwth-aachen.de/chisv"
              >CHISV (more info)</a
            >
          </p>
          <div>
            <form @submit.prevent>
              <b-field>
                <b-input
                  @input="error = null"
                  v-model="email"
                  icon="email"
                  autofocus
                  type="email"
                  placeholder="E-Mail Address"
                >
                </b-input>
              </b-field>

              <b-field>
                <b-input
                  @input="error = null"
                  v-model="password"
                  icon="key"
                  type="password"
                  placeholder="Password"
                  required
                >
                </b-input>
              </b-field>

              <b-field v-if="error">
                <p class="has-text-danger">{{ error }}</p>
              </b-field>

              <b-field>
                <button
                  :disabled="error || !email || !password"
                  @click="processLogin()"
                  class="button is-primary"
                >
                  Login
                </button>
              </b-field>
            </form>

            <b-field grouped position="is-right">
              <b-button
                tag="router-link"
                :to="{ name: 'passwordForgot', query: { email: this.email } }"
                size="is-small"
                type="is-text"
              >
                Forgot password
              </b-button>
              <b-button
                tag="router-link"
                :to="{ name: 'register' }"
                size="is-small"
                type="is-text"
              >
                Create account
              </b-button>
            </b-field>
          </div>
        </div>
        <div class="card-footer">
          <div class="card-footer-item pl-6 pr-6">
            <div class="columns is-centered">
              <div class="column is-9">
                <a href="https://hci.rwth-aachen.de/chisv" target="_blank">
                  <img src="/images/i10logo.svg"
                /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/api";
import { mapActions } from "vuex";

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      error: null,
    };
  },
  methods: {
    processLogin() {
      this.error = null;
      this.login({ email: this.email, password: this.password }).catch(
        (error) => {
          if (error.response && error.response.status == 422) {
            // Credentials are wrong
            this.error = "We have no account for these credentials";
          } else {
            console.error(JSON.stringify(error.repsonse));
          }
        }
      );
    },
    ...mapActions("auth", ["fetchUser", "login"]),
  },
};
</script>
