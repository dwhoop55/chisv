<template>
  <div>
    <div class="is-flex" style="justify-content: flex-end;">
      <b-button
        size="is-small"
        type="is-danger"
        outlined
        @click="removeUiPreferences()"
      >Reset UI preferences</b-button>
    </div>

    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
      <div class="is-flex">
        <b-field>
          <image-component
            v-if="user"
            v-model="user"
            type="avatar"
            size="128x128"
            text=" Drop new face..<br />png, jpg, gif<br />max 128x128"
          ></image-component>
        </b-field>

        <div class="has-padding-l-5" style="flex-grow:2">
          <div class="is-block">
            <b-field
              expanded
              :type="{ 'is-danger': form.errors.has('firstname') }"
              :message="form.errors.get('firstname')"
              label="Firstname"
            >
              <b-input required v-model="form.firstname"></b-input>
            </b-field>

            <b-field
              expanded
              :type="{ 'is-danger': form.errors.has('lastname') }"
              :message="form.errors.get('lastname')"
              label="Lastname"
            >
              <b-input required v-model="form.lastname"></b-input>
            </b-field>

            <b-field
              expanded
              :type="{ 'is-danger': form.errors.has('email') }"
              :message="form.errors.get('email')"
              label="E-Mail"
            >
              <b-input required v-model="form.email"></b-input>
            </b-field>
          </div>
        </div>
      </div>

      <b-field
        :type="{ 'is-danger': form.errors.has('languages') }"
        :message="form.errors.get('languages')"
        label="Languages"
      >
        <language-picker v-model="form.languages"></language-picker>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('degree_id') }"
        :message="form.errors.get('degree_id')"
        label="Degree program"
      >
        <degree-picker v-model="form.degree_id"></degree-picker>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('location') }"
        :message="form.errors.get('location')"
        label="City (closest)"
      >
        <location-picker v-model="form.location"></location-picker>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('university') }"
        :message="form.errors.get('university')"
        label="University"
      >
        <university-picker v-model="form.university"></university-picker>
      </b-field>

      <!-- <b-field
      :type="{ 'is-danger': form.errors.has('timezone_id') }"
      :message="form.errors.get('timezone_id')"
      label="All dates are converted to this timezone"
    >
      <b-tooltip position="is-bottom" label="Not used yet, but please set it" always>
        <timezone-picker v-model="form.timezone_id"></timezone-picker>
      </b-tooltip>
      </b-field>-->

      <b-field grouped>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('past_conferences') }"
          :message="form.errors.get('past_conferences')"
          label="Past conferences you have attended"
        >
          <b-input v-model="form.past_conferences"></b-input>
        </b-field>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('past_conferences_sv') }"
          :message="form.errors.get('past_conferences_sv')"
          label="Past conferences you have attended as SV"
        >
          <b-input v-model="form.past_conferences_sv"></b-input>
        </b-field>
      </b-field>

      <b-field
        :type="{ 'is-danger': form.errors.has('shirt_id') }"
        :message="form.errors.get('shirt_id')"
        label="T-Shirt"
      >
        <shirt-picker v-model="form.shirt_id"></shirt-picker>
      </b-field>

      <button :disabled="form.busy" type="submit" class="button is-success is-pulled-right">Apply</button>
    </form>
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api.js";

export default {
  props: ["user"],
  model: {
    prop: "user"
  },
  data() {
    return {
      form: new Form({
        id: this.user.id,
        firstname: this.user.firstname,
        lastname: this.user.lastname,
        email: this.user.email,
        languages: this.user.languages,
        degree_id: this.user.degree_id,
        past_conferences: this.user.past_conferences,
        past_conferences_sv: this.user.past_conferences_sv,
        shirt_id: this.user.shirt_id,
        location: this.user.location,
        university: this.user.university
          ? this.user.university
          : { name: this.user.university_fallback },
        timezone_id: this.user.timezone_id
      })
    };
  },

  methods: {
    save() {
      api
        .updateUser(this.user.id, this.form)
        .then(data => {
          this.$emit("input", data.data.result);
          this.$buefy.toast.open({
            message: "Changes saved!",
            type: "is-success"
          });
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: `Could not save user: ${error.message}`,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {});
    },

    removeUiPreferences() {
      localStorage.removeItem("vuex");
      this.$buefy.notification.open({
        duration: 5000,
        message: `Preferences reset`,
        type: "is-success",
        hasIcon: true
      });
      this.$store.commit("INIT");
      this.$store.commit("PROFILE_TAB", 0);
    }
  }
};
</script>
