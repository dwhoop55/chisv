<template>
  <div class="columns is-centered">
    <div class="column is-5">
      <div class="card">
        <b-loading :is-full-page="false" v-model="showSuccess">
          <b-icon size="is-large" type="is-success" icon="check-bold"></b-icon>
        </b-loading>
        <header class="card-header">
          <p class="card-header-title is-block has-text-centered">
            Set new password
          </p>
        </header>
        <div class="card-content">
          <b-field>
            <b-input
              :disabled="disabled"
              v-model="email"
              icon="at"
              type="email"
              placeholder="E-Mail Address"
              name="email"
              required
              autofocus
            />
          </b-field>

          <b-field>
            <b-input
              :disabled="disabled"
              v-model="password"
              icon="key"
              type="password"
              placeholder="New password"
              name="password"
              required
            />
          </b-field>

          <b-field>
            <b-input
              :disabled="disabled"
              v-model="passwordConfirmation"
              icon="key"
              type="password"
              placeholder="Confirm new password"
              name="password_confirm"
              required
            />
          </b-field>

          <b-field grouped>
            <b-field>
              <b-button :disabled="disabled" @click="reset" type="is-primary">
                Set new password
              </b-button>
            </b-field>
            <b-field>
              <b-button
                tag="router-link"
                :to="{ name: 'passwordForgot', query: { email } }"
                type="is-text"
              >
                Request new email
              </b-button>
            </b-field>
          </b-field>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      token: null,
      email: null,
      password: null,
      passwordConfirmation: null,
      disabled: false,
      showSuccess: false,
    };
  },
  created() {
    this.token = this.$route.params.token;
    this.email = this.$route.query.email;
  },

  methods: {
    reset() {
      this.disabled = true;
      this.passwordReset({
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
        token: this.token,
      })
        .then(({ data }) => {
          this.showSuccess = true;
        })
        .catch((error) => {
          this.disabled = false;
        });
    },
    ...mapActions("auth", ["passwordReset"]),
  },
};
</script>