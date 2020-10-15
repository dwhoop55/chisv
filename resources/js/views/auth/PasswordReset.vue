<template>
  <div class="columns is-centered">
    <div class="column is-half">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title is-block has-text-centered">
            Set Password
          </p>
        </header>
        <div class="card-content">
          <b-field>
            <b-input
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
              icon="key"
              type="password"
              placeholder="New password"
              name="password"
              required
            />
          </b-field>

          <b-field>
            <b-input
              icon="key"
              type="password"
              placeholder="Confirm new password"
              name="password_confirm"
              required
            />
          </b-field>

          <b-button type="is-primary"> Set new password </b-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: null,
    };
  },
  created() {
    this.token = this.$route.params.token;
  },
};
</script>