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
                :type="typeForFormField('firstname', form)"
                :message="form.errors.get('firstname')"
                label="First name"
              >
                <b-input
                  required
                  v-model="form.firstname"
                  placeholder="Milton"
                  @input="form.errors.clear('firstname')"
                ></b-input>
              </b-field>
              <b-field
                :type="typeForFormField('lastname', form)"
                :message="form.errors.get('lastname')"
                label="Last name"
              >
                <b-input
                  required
                  v-model="form.lastname"
                  placeholder="Waddams"
                  @input="form.errors.clear('lastname')"
                ></b-input>
              </b-field>

              <b-field
                :type="typeForFormField('email', form)"
                :message="form.errors.get('email')"
                label="E-Mail (use an institutional address)"
              >
                <b-input
                  required
                  type="email"
                  icon="email"
                  v-model="form.email"
                  placeholder="you@your-university.edu"
                  @input="form.errors.clear('email')"
                ></b-input>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field
                :type="typeForFormField('languages', form)"
                :message="form.errors.get('languages')"
                label="Languages"
              >
                <language-picker
                  v-model="form.languages"
                  @input="form.errors.clear('languages')"
                ></language-picker>
              </b-field>

              <b-field label="Home Country">
                <location-picker
                  v-model="form.location"
                  :message="form.errors.get('location')"
                  :type="typeForFormField('location', form)"
                  @input="form.errors.clear('location')"
                ></location-picker>
              </b-field>

              <b-field
                :type="typeForFormField('university', form)"
                :message="form.errors.get('university')"
                label="University"
              >
                <university-picker
                  v-model="form.university"
                  @input="form.errors.clear('university')"
                ></university-picker>
              </b-field>

              <b-field
                :type="typeForFormField('locale_id', form)"
                :message="form.errors.get('locale_id')"
                label="Preferred locale"
              >
                <b-select
                  expanded
                  v-model="form.locale_id"
                  @input="form.errors.clear('locale_id')"
                >
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
                :type="typeForFormField('degree_id', form)"
                :message="form.errors.get('degree_id')"
                label="Degree program"
              >
                <degree-picker
                  v-model="form.degree_id"
                  @input="form.errors.clear('degree_id')"
                ></degree-picker>
              </b-field>

              <b-field
                :type="typeForFormField('shirt_id', form)"
                :message="form.errors.get('shirt_id')"
                label="T-Shirt"
              >
                <shirt-picker
                  v-model="form.shirt_id"
                  @input="form.errors.clear('shirt_id')"
                ></shirt-picker>
              </b-field>

              <b-field expanded>&nbsp;</b-field>

              <b-field
                :type="typeForFormField('past_conferences', form)"
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
                :type="typeForFormField('past_conferences_sv', form)"
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

              <b-field
                label="Password"
                :type="typeForFormField('password', form)"
              >
                <b-input
                  type="password"
                  v-model="form.password"
                  password-reveal
                  placeholder="Your password"
                  required
                  @input="form.errors.clear('password')"
                ></b-input>
              </b-field>

              <b-field
                label="Confirm"
                :type="typeForFormField('password', form)"
                :message="form.errors.get('password')"
              >
                <b-input
                  type="password"
                  v-model="form.password_confirmation"
                  password-reveal
                  placeholder="Confirm your password"
                  required
                  @input="form.errors.clear('password')"
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
import { mapActions, mapGetters } from "vuex";

export default {
  name: "Register",

  data() {
    return {
      form: new Form({
        firstname: "",
        lastname: "",
        email: "",
        languages: [{ id: 1, name: "English", code: "en" }],
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
    };
  },

  methods: {
    save() {
      this.register(this.form);
    },
    ...mapActions("auth", ["register"]),
  },

  computed: mapGetters("defines", ["locales", "languages"]),
};
</script>