<template>
  <section>
    <b-tabs expanded :animated="false" v-model="activeTab">
      <b-tab-item icon="wrench" label="General">
        <form @submit.prevent="save" @keydown="profileForm.onKeydown($event)">
          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('name') }"
            :message="generalForm.errors.get('name')"
            label="Name"
          >
            <b-input required v-model="generalForm.name"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('key') }"
            :message="generalForm.errors.get('key')"
            label="Key (https://chisv.org/conference/key)"
          >
            <b-input required v-model="generalForm.key"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('location') }"
            :message="generalForm.errors.get('location')"
            label="Location"
          >
            <b-input required v-model="generalForm.location"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('timezone_id') }"
            :message="generalForm.errors.get('timezone_id')"
            label="Timezone"
          >
            <timezone-picker v-model="generalForm.timezone_id"></timezone-picker>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('start_date')||generalForm.errors.has('end_date') }"
            :message="generalForm.errors.get('start_date') + generalForm.errors.get('end_date')"
            label="Date"
          >
            <b-datepicker v-model="dateRange" range inline></b-datepicker>
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

export default {
  props: ["canDelete", "conferenceKey"],

  computed: {
    dateRange: function() {
      if (this.generalForm.start_date && this.generalForm.end_date) {
        return [
          new Date(
            Date.parse(this.generalForm.start_date.replace("-", "/", "g"))
          ),
          new Date(Date.parse(this.generalForm.end_date.replace("-", "/", "g")))
        ];
      }
    }
  },

  data() {
    return {
      conference: null,
      activeTab: 0,
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
          this.$buefy.toast.open({
            duration: 5000,
            message: `Could not save conference: ${error.message}`,
            type: "is-danger"
          });
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
          this.generalForm.fill(conference);
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