<template>
  <section>
    <b-tabs expanded :animated="false" v-model="activeTab">
      <b-tab-item icon="wrench" label="General">
        <form @submit.prevent="save" @keydown="generalForm.onKeydown($event)">
          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('name') }"
            :message="generalForm.errors.get('name')"
            label="Name"
          >
            <b-input required v-model="generalForm.name" maxlength="70"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('key') }"
            :message="generalForm.errors.get('key')"
            label="Key (https://chisv.org/conference/key)"
          >
            <b-input required v-model="generalForm.key" maxlength="30"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('location') }"
            :message="generalForm.errors.get('location')"
            label="Location"
          >
            <b-input required v-model="generalForm.location" maxlength="70"></b-input>
          </b-field>

          <b-field grouped>
            <b-field
              expanded
              :type="{ 'is-danger': generalForm.errors.has('timezone_id') }"
              :message="generalForm.errors.get('timezone_id')"
              label="Timezone the conference takes place in"
            >
              <timezone-picker @timezone="(tz) => timezone=tz" v-model="generalForm.timezone_id"></timezone-picker>
            </b-field>
            <b-field
              label="Days the conference is running"
              expanded
              :type="{ 'is-danger': hasDateErrors }"
              :message="dateErrors"
            >
              <b-datepicker @input="updateDateRange" :value="dateRange" range></b-datepicker>
            </b-field>
          </b-field>

          <b-field
            label="Description"
            expanded
            :type="{ 'is-danger': generalForm.errors.has('description') }"
            :message="generalForm.errors.get('description')"
          >
            <b-input maxlength="300" v-model="generalForm.description" type="textarea"></b-input>
          </b-field>

          <b-field
            label="State"
            expanded
            :type="{ 'is-danger': generalForm.errors.has('state_id') }"
            :message="generalForm.errors.get('state_id')"
          >
            <state-picker :range="[0,10]" v-model="generalForm.state_id"></state-picker>
          </b-field>

          <b-field
            label="Enable bidding"
            expanded
            :type="{ 'is-danger': generalForm.errors.has('enable_bidding') }"
            :message="generalForm.errors.get('enable_bidding')"
          >
            <b-switch v-model="generalForm.enable_bidding"></b-switch>
          </b-field>

          <button
            :disabled="generalForm.busy"
            type="submit"
            class="button is-primary is-pulled-right"
          >Save</button>
        </form>
      </b-tab-item>

      <b-tab-item icon="image" label="Image"></b-tab-item>

      <b-tab-item icon="sign-caution" label="Administrative">
        <button
          v-if="canDelete"
          @click="destroy"
          class="button is-danger is-pulled-right"
        >Delete this conference</button>
      </b-tab-item>
    </b-tabs>
    <b-loading :is-full-page="false" :active.sync="isLoading || generalForm.busy"></b-loading>
  </section>
</template>

<script>
import { Form } from "vform";
import api from "@/api.js";
import moment from "moment-timezone";

export default {
  props: ["canDelete", "conferenceKey"],

  computed: {
    dateErrors: function() {
      if (this.hasDateErrors) {
        return (
          this.generalForm.errors.get("start_date") +
          "<br/> " +
          this.generalForm.errors.get("end_date")
        );
      }
    },
    hasDateErrors: function() {
      return (
        this.generalForm.errors.has("start_date") ||
        this.generalForm.errors.has("end_date")
      );
    },
    dateRange: function() {
      if (
        this.generalForm.start_date &&
        this.generalForm.end_date &&
        this.timezone
      ) {
        return [
          new Date(this.generalForm.start_date),
          new Date(this.generalForm.end_date)
        ];
      }
    }
  },

  data() {
    return {
      conference: null,
      activeTab: 0,
      timezone: null,
      generalForm: new Form({
        id: null,
        name: null,
        key: this.conferenceKey,
        location: null,
        timezone_id: null,
        start_date: null,
        end_date: null,
        description: null,
        state_id: null,
        enable_bidding: null,
        created_at: null,
        updated_at: null
      }),
      isLoading: true
    };
  },

  mounted() {
    this.load();
  },

  methods: {
    updateDateRange: function($event) {
      this.generalForm.start_date = $event[0].toMySqlDate();
      this.generalForm.end_date = $event[1].toMySqlDate();
    },
    save() {
      var form;
      switch (this.activeTab) {
        case 0: //general
          form = this.generalForm;
          break;
      }
      this.isLoading = true;
      api
        .updateConference(this.conferenceKey, form)
        .then(data => {
          this.load();
          this.$buefy.toast.open({
            message: "Changes saved!",
            type: "is-success"
          });
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.$buefy.toast.open({
              duration: 5000,
              message: `Some fields are invalid`,
              type: "is-danger"
            });
          } else {
            this.$buefy.toast.open({
              duration: 5000,
              message: `Could not save conference: ${error.message}`,
              type: "is-danger"
            });
          }
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    destroy() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.conference.name}?`,
        onConfirm: () => {
          this.isLoading = true;
          api
            .destroyConference(this.conferenceKey)
            .then(() => {
              this.goTo("/conference");
            })
            .catch(error => {
              this.$buefy.toast.open({
                message: `An error occured: ${error}`,
                type: "is-danger"
              });
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    },
    load() {
      this.isLoading = true;
      api
        .getConference(this.conferenceKey)
        .then(data => {
          let conference = data.data;
          this.conference = conference;
          this.timezone = conference.timezone;
          this.generalForm.fill(conference);
          this.generalForm.enable_bidding =
            this.generalForm.enable_bidding == "1" ? true : false;
        })
        .catch(error => {
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>