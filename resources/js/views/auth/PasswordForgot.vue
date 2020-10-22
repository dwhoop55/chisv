<template>
  <div class="columns is-centered">
    <div class="column is-4">
      <div class="card">
        <header class="card-header">
          <p class="card-header-icon">
            <b-icon @click.native="$router.go(-1)" icon="arrow-left"> </b-icon>
          </p>
        </header>
        <div class="card-content">
          <form @submit.prevent>
            <b-field>
              <b-input
                :disabled="disabled"
                icon="at"
                type="email"
                placeholder="E-Mail Address"
                name="email"
                v-model="email"
                required
                autofocus
              />
            </b-field>

            <b-field>
              <button
                :disabled="disabled"
                @click="sendLink"
                class="button is-primary"
              >
                Send Password Reset Link
              </button>
            </b-field>

            <b-field>
              <b-message v-if="message" type="is-success" has-icon>
                {{ message }}
              </b-message>
            </b-field>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/api";
export default {
  data() {
    return {
      disabled: false,
      message: "",
      email: "",
    };
  },

  created() {
    this.email = this.$route.query.email;
  },

  methods: {
    sendLink() {
      this.message = null;
      this.disabled = true;
      api
        .passwordForgot(this.email)
        .then(({ data }) => {
          this.message = data.message;
        })
        .catch((error) => {
          this.disabled = false;
        });
    },
  },
};
</script>