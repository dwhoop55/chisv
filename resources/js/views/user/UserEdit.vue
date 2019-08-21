<template>
  <section>
    <b-tabs expanded :animated="false" v-model="activeTab">
      <b-tab-item icon="format-list-bulleted" label="Conferences">
        <div v-if="user">
          <b-button @click="showGrantModal=true" class="is-pulled-right" v-if="canGrant">Grant</b-button>
          <b-modal :active.sync="showGrantModal" has-modal-card>
            <grant-permission-modal @granted="load" :user="user"></grant-permission-modal>
          </b-modal>

          <div class="subtitle has-margin-t-3">
            <p v-if="hasActivePermissions">Active conferences</p>
            <p v-else>Not associated to active conferences</p>
          </div>
          <div class="column" v-for="permission in activePermissions" v-bind:key="permission.id">
            <permission-card @revoked="load" @updated="load" :permission="permission" />
          </div>

          <div class="subtitle has-margin-t-3">
            <p v-if="hasPastPermissions">Ended conferences</p>
            <p v-else>No other permissions</p>
          </div>
          <div class="column" v-for="permission in pastPermissions" v-bind:key="permission.id">
            <permission-card @revoked="load" @updated="load" :permission="permission" />
          </div>
        </div>
      </b-tab-item>

      <b-tab-item icon="account" label="Profile">
        <form @submit.prevent="save" @keydown="profileForm.onKeydown($event)">
          <b-field grouped>
            <b-field
              expanded
              :type="{ 'is-danger': profileForm.errors.has('firstname') }"
              :message="profileForm.errors.get('firstname')"
              label="Firstname"
            >
              <b-input required v-model="profileForm.firstname"></b-input>
            </b-field>
            <b-field
              expanded
              :type="{ 'is-danger': profileForm.errors.has('lastname') }"
              :message="profileForm.errors.get('lastname')"
              label="Lastname"
            >
              <b-input required v-model="profileForm.lastname"></b-input>
            </b-field>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': profileForm.errors.has('email') }"
            :message="profileForm.errors.get('email')"
            label="E-Mail"
          >
            <b-input required v-model="profileForm.email"></b-input>
          </b-field>

          <b-field
            :type="{ 'is-danger': profileForm.errors.has('languages') }"
            :message="profileForm.errors.get('languages')"
            label="Languages"
          >
            <language-picker v-model="profileForm.languages"></language-picker>
          </b-field>

          <b-field
            :type="{ 'is-danger': profileForm.errors.has('degree_id') }"
            :message="profileForm.errors.get('degree_id')"
            label="Degree program"
          >
            <degree-picker v-model="profileForm.degree_id"></degree-picker>
          </b-field>

          <b-field grouped>
            <b-field
              expanded
              :type="{ 'is-danger': profileForm.errors.has('past_conferences') }"
              :message="profileForm.errors.get('past_conferences')"
              label="Past conferences you have attended"
            >
              <b-input v-model="profileForm.past_conferences"></b-input>
            </b-field>
            <b-field
              expanded
              :type="{ 'is-danger': profileForm.errors.has('past_conferences_sv') }"
              :message="profileForm.errors.get('past_conferences_sv')"
              label="Past conferences you have attended as SV"
            >
              <b-input v-model="profileForm.past_conferences_sv"></b-input>
            </b-field>
          </b-field>

          <b-field
            :type="{ 'is-danger': profileForm.errors.has('shirt_id') }"
            :message="profileForm.errors.get('shirt_id')"
            label="T-Shirt"
          >
            <shirt-picker v-model="profileForm.shirt_id"></shirt-picker>
          </b-field>

          <button
            :disabled="isLoading || profileForm.busy"
            type="submit"
            class="button is-primary is-pulled-right"
          >Save</button>
        </form>
      </b-tab-item>

      <b-tab-item icon="earth" label="Locale">
        <form @submit.prevent="save" @keydown="localeForm.onKeydown($event)">
          <b-field
            :type="{ 'is-danger': localeForm.errors.has('location') }"
            :message="localeForm.errors.get('location')"
            label="City (closest)"
          >
            <location-picker v-model="localeForm.location"></location-picker>
          </b-field>

          <b-field
            :type="{ 'is-danger': localeForm.errors.has('university') }"
            :message="localeForm.errors.get('university')"
            label="University"
          >
            <university-picker v-model="localeForm.university"></university-picker>
          </b-field>

          <!-- <b-field
            :type="{ 'is-danger': localeForm.errors.has('timezone_id') }"
            :message="localeForm.errors.get('timezone_id')"
            label="All dates are converted to this timezone"
          >
            <b-tooltip position="is-bottom" label="Not used yet, but please set it" always>
              <timezone-picker v-model="localeForm.timezone_id"></timezone-picker>
            </b-tooltip>
          </b-field>-->

          <button
            :disabled="localeForm.busy"
            type="submit"
            class="button is-primary is-pulled-right"
          >Save</button>
        </form>
      </b-tab-item>

      <b-tab-item icon="key" label="Password">
        <form @submit.prevent="save" @keydown="passwordForm.onKeydown($event)">
          <b-field label="Password">
            <b-input
              type="password"
              v-model="passwordForm.password"
              password-reveal
              placeholder="Your password"
              required
            ></b-input>
          </b-field>

          <b-field
            label="Confirm Password"
            :type="{ 'is-danger': passwordForm.errors.has('password') }"
            :message="passwordForm.errors.get('password')"
          >
            <b-input
              type="password"
              v-model="passwordForm.password_confirmation"
              password-reveal
              placeholder="Confirm your password"
              required
            ></b-input>
          </b-field>

          <button
            :disabled="passwordForm.busy"
            type="submit"
            class="button is-primary is-pulled-right"
          >Set new password</button>
        </form>
      </b-tab-item>

      <b-tab-item v-if="canDelete" icon="sign-caution" label="Delete">
        <button @click="destroy" class="button is-danger is-pulled-right">Delete this user</button>
      </b-tab-item>
    </b-tabs>

    <b-loading
      :is-full-page="false"
      :active.sync="isLoading || profileForm.busy || localeForm.busy || passwordForm.busy"
    ></b-loading>
  </section>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  props: ["userId", "canDelete", "canGrant"],

  computed: {
    activePermissions: function() {
      return this.user.permissions.filter(function(permission) {
        return permission.conference && permission.conference.state_id != 6;
      });
    },
    hasActivePermissions: function() {
      return this.activePermissions.length != 0;
    },
    pastPermissions: function() {
      return this.user.permissions.filter(function(permission) {
        return !permission.conference || permission.conference.state_id == 6;
      });
    },
    hasPastPermissions: function() {
      return this.pastPermissions.length != 0;
    }
  },

  data() {
    return {
      profileForm: new Form({
        id: null,
        firstname: "",
        lastname: "",
        email: "",
        languages: [],
        degree_id: null,
        past_conferences: "",
        past_conferences_sv: "",
        shirt_id: null
      }),
      localeForm: new Form({
        id: null,
        location: {},
        university: {},
        timezone_id: null
      }),
      passwordForm: new Form({
        id: null,
        password: "",
        password_confirmation: ""
      }),
      user: null,
      isLoading: true,
      activeTab: 0,
      showGrantModal: false
    };
  },

  mounted() {
    this.load();
  },

  methods: {
    destroy() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.user.firstname} ${this.user.lastname}?`,
        onConfirm: () => {
          api
            .destroyUser(this.user.id)
            .then(() => {
              this.goTo("/user");
            })
            .catch(error => {
              this.$buefy.notification.open({
                queue: false,
                duration: 5000,
                message: `Error: ${error.message}`,
                type: "is-danger",
                hasIcon: true
              });
            });
        }
      });
    },
    save() {
      var form;
      switch (this.activeTab) {
        case 1: //profile
          form = this.profileForm;
          break;

        case 2: // locale
          form = this.localeForm;
          break;

        case 3: //password
          form = this.passwordForm;
          break;
      }
      api
        .updateUser(this.userId, form)
        .then(data => {
          this.load();
          this.$buefy.toast.open({
            queue: false,
            message: "Changes saved!",
            type: "is-success"
          });
        })
        .catch(error => {
          this.$buefy.notification.open({
            queue: false,
            duration: 5000,
            message: `Could not save user: ${error.message}`,
            type: "is-danger",
            hasIcon: true
          });
        });
    },
    load() {
      this.isLoading = true;
      api
        .getUser(this.userId)
        .then(data => {
          let user = data.data;
          this.user = user;
          this.profileForm.fill(user);
          this.localeForm.fill(user);
          this.localeForm.fill(user);

          if (user.university) {
            this.localeForm.university = user.university;
          } else {
            this.localeForm.university = { name: user.university_fallback };
          }
        })
        .catch(error => {
          if (error.response.status == 403) {
            // Unauthorized
            this.goTo("/user");
          }
          this.$buefy.notification.open({
            queue: false,
            duration: 5000,
            message: `Could not fetch user: ${error.message}`,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>