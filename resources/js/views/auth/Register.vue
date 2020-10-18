<template>
  <div class="columns is-centered">
    <div class="column is-7">
      <div class="card">
        <header class="card-header">
          <p class="card-header-icon">
            <b-icon @click.native="$router.go(-1)" icon="arrow-left"> </b-icon>
          </p>
          <p class="card-header-title is-block has-text-centered">Sign up</p>
        </header>
        <div class="card-content">
          <section>
            <form @submit.prevent="save" @keydown="form.onKeydown($event)">
              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('firstname') }"
                :message="form.errors.get('firstname')"
                label="First name"
              >
                <b-input required v-model="form.firstname"></b-input>
              </b-field>
              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('lastname') }"
                :message="form.errors.get('lastname')"
                label="Last name"
              >
                <b-input required v-model="form.lastname"></b-input>
              </b-field>

              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('email') }"
                :message="form.errors.get('email')"
                label="E-Mail (use an institutional address)"
              >
                <b-input required icon="email" v-model="form.email"></b-input>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field
                :type="{ 'is-danger': form.errors.has('languages') }"
                :message="form.errors.get('languages')"
                label="Languages"
              >
                <language-picker v-model="form.languages"></language-picker>
              </b-field>

              <b-field
                :type="{ 'is-danger': form.errors.has('location') }"
                :message="form.errors.get('location')"
                label="Home Country"
              >
                <location-picker v-model="form.location"></location-picker>
              </b-field>

              <b-field
                :type="{ 'is-danger': form.errors.has('university.name') }"
                :message="form.errors.get('university.name')"
                label="University"
              >
                <university-picker
                  v-model="form.university"
                ></university-picker>
              </b-field>

              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('locale_id') }"
                :message="form.errors.get('locale_id')"
                label="Preferred locale"
              >
                <b-select expanded v-model="form.locale_id">
                  <option
                    v-for="locale in locales"
                    :value="locale.id"
                    :key="locale.id"
                  >
                    {{ locale.name }}
                  </option>
                </b-select>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('degree_id') }"
                :message="form.errors.get('degree_id')"
                label="Degree program"
              >
                <degree-picker v-model="form.degree_id"></degree-picker>
              </b-field>

              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('shirt_id') }"
                :message="form.errors.get('shirt_id')"
                label="T-Shirt"
              >
                <shirt-picker v-model="form.shirt_id"></shirt-picker>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('past_conferences') }"
                :message="form.errors.get('past_conferences')"
                label="Past conferences you have attended"
              >
                <b-taginput
                  placeholder="E.g. CHI2019, UIST2020"
                  icon="tag"
                  :attached="true"
                  v-model="form.past_conferences"
                ></b-taginput>
              </b-field>
              <b-field
                expanded
                :type="{
                  'is-danger': form.errors.has('past_conferences_sv'),
                }"
                :message="form.errors.get('past_conferences_sv')"
                label="Past conferences you have attended as SV"
              >
                <b-taginput
                  placeholder="E.g. CHI2019, UIST2020"
                  icon="tag"
                  :attached="true"
                  v-model="form.past_conferences_sv"
                ></b-taginput>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field expanded label="Password">
                <b-input
                  type="password"
                  v-model="form.password"
                  password-reveal
                  placeholder="Your password"
                  required
                ></b-input>
              </b-field>

              <b-field expanded label="Confirm">
                <b-input
                  type="password"
                  v-model="form.password_confirmation"
                  password-reveal
                  placeholder="Confirm your password"
                  required
                ></b-input>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field grouped position="is-right">
                <button
                  :disabled="form.busy"
                  type="submit"
                  class="button is-primary"
                >
                  Sign up
                </button>
              </b-field>
            </form>

            <b-loading
              animation
              :is-full-page="true"
              :active.sync="form.busy"
            ></b-loading>

            <b-modal
              :has-modal-card="true"
              :can-cancel="false"
              :active.sync="registerSuccess"
            >
              <div class="modal-card">
                <header class="modal-card-head">
                  <p class="modal-card-title">Welcome on board!</p>
                </header>
                <section class="modal-card-body">
                  <p class="is-size-5">
                    You can now see all conferences and enroll. Happy SV-ing!
                  </p>
                </section>
                <footer class="modal-card-foot">
                  <b-button type="is-success" @click="goTo('/login')"
                    >Continue to login</b-button
                  >
                </footer>
              </div>
            </b-modal>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import { mapGetters } from "vuex";

export default {
  name: "Register",

  data() {
    return {
      form: new Form({
        firstname: "",
        lastname: "",
        email: "",
        languages: [],
        degree_id: null,
        past_conferences: [],
        past_conferences_sv: [],
        shirt_id: null,
        location: {},
        university: {},
        locale_id: 40,
        password: "",
        password_confirmation: "",
      }),
      registerSuccess: false,
    };
  },

  methods: {
    save() {
      this.form.post(`register`).then((data) => (this.registerSuccess = true));
    },
  },

  computed: mapGetters("defines", ["locales"]),
};
</script>