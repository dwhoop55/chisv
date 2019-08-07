<template>
  <div class="columns is-centered has-margin-t-1">
    <div class="column is-half">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">Login</p>
        </header>
        <div class="card-content">
          <form
            id="login_form"
            method="POST"
            action="/login"
            aria-label="Login"
            @keydown="form.onKeydown($event)"
          >
            <input type="hidden" name="_token" :value="csrf_token" />
            <input class="input" name="email" type="hidden" :value="form.email" />
            <input class="input" name="password" type="hidden" :value="form.password" />

            <b-field expanded label="E-Mail">
              <b-input required v-model="form.email"></b-input>
            </b-field>

            <b-field expanded label="Password">
              <b-input required v-model="form.password" type="password" password-reveal></b-input>
            </b-field>

            <div class="field is-grouped is-grouped-right">
              <p class="control">
                <button type="submit" class="button is-primary">Login</button>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";

export default {
  data: () => ({
    form: new Form({
      email: "",
      password: ""
    })
  }),

  computed: {
    csrf_token() {
      let token = document.head.querySelector('meta[name="csrf-token"]');
      return token.content;
    }
  },

  methods: {
    login() {
      document.getElementById("login_form").submit();
    }
  }
};
</script>