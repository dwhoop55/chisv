<template>
  <div>
    <div class="is-flex" style="justify-content: flex-end;">
      <b-button
        size="is-small"
        type="is-danger"
        outlined
        v-if="canDelete"
        @click="deleteConference()"
      >Delete this conference</b-button>
    </div>

    <form @submit.prevent="save" @keydown="form.onKeydown($event)">
      <div class="is-flex is-flex-wrap">
        <b-field>
          <image-component
            v-if="conference"
            v-model="conference"
            type="artwork"
            size="128x128"
            text="<br />Drop new artwork..<br />max 4096x4096<br /> < 1024kb"
          ></image-component>
        </b-field>
        <b-field class="has-padding-l-5">
          <image-component
            v-if="conference"
            v-model="conference"
            type="icon"
            size="128x128"
            text="<br />Drop new icon..<br />max 128x128<br /> < 1024kb"
          ></image-component>
        </b-field>
        <div class="has-padding-l-5" style="flex-grow:2">
          <b-field
            expanded
            :type="{ 'is-danger': form.errors.has('name') }"
            :message="form.errors.get('name')"
            label="Name"
          >
            <b-input required v-model="form.name" maxlength="70"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': form.errors.has('key') }"
            :message="form.errors.get('key')"
            label="Key (https://chisv.org/conference/key)"
          >
            <b-input required v-model="form.key" maxlength="30"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': form.errors.has('location') }"
            :message="form.errors.get('location')"
            label="Location"
          >
            <b-input
              required
              v-model="form.location"
              maxlength="70"
              placeholder="e.g. City, State, Country - or - City, Country"
            ></b-input>
          </b-field>
        </div>
      </div>

      <b-field grouped>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('timezone_id') }"
          :message="form.errors.get('timezone_id')"
          label="Timezone the conference takes place in"
        >
          <timezone-picker @timezone="(tz) => timezone=tz" v-model="form.timezone_id"></timezone-picker>
        </b-field>
        <b-field
          label="Days the conference is running"
          expanded
          :type="{ 'is-danger': hasDateErrors }"
          :message="dateErrors"
        >
          <b-datepicker
            placeholder="Select a range"
            @input="updateDateRange($event)"
            :value="dateRange"
            range
            icon="calendar-today"
          ></b-datepicker>
        </b-field>
      </b-field>

      <b-field
        label="Description"
        expanded
        :type="{ 'is-danger': form.errors.has('description') }"
        :message="form.errors.get('description')"
      >
        <markdown-input
          v-model="form.description"
          maxlength="1000"
          placeholder="Let your users know what the conference is about"
        />
      </b-field>

      <p>Leave any of the fields empty to hide the info</p>
      <b-field grouped>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('url_name') }"
          :message="form.errors.get('url_name')"
          label="External link button caption"
        >
          <b-input v-model="form.url_name" maxlength="100" placeholder="e.g. ACM, Website, More"></b-input>
        </b-field>
        <b-field
          label="External link URL"
          expanded
          :type="{ 'is-danger': form.errors.has('url') }"
          :message="form.errors.get('url')"
        >
          <b-input v-model="form.url" maxlength="300" placeholder="e.g. https://acm.org"></b-input>
        </b-field>
      </b-field>

      <b-field
        expanded
        :type="{ 'is-danger': form.errors.has('email_chair') }"
        :message="form.errors.get('email_chair')"
        label="Email of the chair managing the conference (will be in the reply-to field of all emails)"
      >
        <b-input required v-model="form.email_chair"></b-input>
      </b-field>

      <b-field
        label="State"
        expanded
        :type="{ 'is-danger': form.errors.has('state_id') }"
        :message="form.errors.get('state_id')"
      >
        <b-select v-model="form.state_id" placeholder="Select a state">
          <option
            v-for="state in statesFor('App\\Conference')"
            :value="state.id"
            :key="state.id"
          >{{ state.name | capitalize }} ({{ state.description }})</option>
        </b-select>
      </b-field>

      <b-field grouped>
        <b-field
          label="Enable bidding on tasks"
          :type="{ 'is-danger': form.errors.has('bidding_enabled') }"
          :message="form.errors.get('bidding_enabled')"
        >
          <b-switch
            v-model="form.bidding_enabled"
          >{{ form.bidding_enabled ? 'Bidding open for days:' : 'Bidding closed' }}</b-switch>
        </b-field>
        <b-field
          expanded
          v-if="form.bidding_enabled"
          label="Bidding open for these days"
          :type="{ 'is-danger': form.errors.has('bidding_start') || form.errors.has('bidding_end') }"
          :message="biddingRangeError"
        >
          <b-datepicker
            :value="biddingRange"
            @input="updateBiddingRange($event)"
            expanded
            range
            icon="calendar-today"
          ></b-datepicker>
        </b-field>
      </b-field>

      <b-field grouped>
        <b-field
          label="Hours volunteers should work (used by auction)"
          expanded
          :type="{ 'is-danger': form.errors.has('volunteer_hours') }"
          :message="form.errors.get('volunteer_hours')"
        >
          <b-numberinput min="0" v-model="form.volunteer_hours"></b-numberinput>
        </b-field>
        <b-field
          label="Max volunteers allowed (used by lottery)"
          expanded
          :type="{ 'is-danger': form.errors.has('volunteer_max') }"
          :message="form.errors.get('volunteer_max')"
        >
          <b-numberinput min="0" v-model="form.volunteer_max"></b-numberinput>
        </b-field>
      </b-field>
      <br />

      <b-field
        expanded
        label="Active Enrollment Form"
        :type="{ 'is-danger': form.errors.has('enrollment_form_id') }"
        :message="form.errors.get('enrollment_form_id')"
      >
        <enrollment-form-template-picker
          v-if="form.state_id == 1"
          v-model="form.enrollment_form_id"
        ></enrollment-form-template-picker>
        <b-notification
          v-else
          has-icon
          type="is-warning"
          :closable="false"
        >The enrollment form can no longer be changed. The enrollment form must not be changed when there are SVs already enrolled</b-notification>
      </b-field>

      <b-field>&nbsp;</b-field>

      <b-field grouped position="is-right">
        <b-button
          type="is-success"
          @click="save()"
          :disabled="form.busy"
          icon-left="content-save"
        >Save</b-button>
      </b-field>
    </form>

    <b-loading :is-full-page="false" :active="isLoading || form.busy"></b-loading>
  </div>
</template>

<script>
import { Form } from "vform";
import api from "@/api.js";
import moment from "moment-timezone";
import { parse } from "path";
import { mapGetters } from "vuex";

export default {
  props: ["conference"],

  computed: {
    biddingRangeError() {
      var message = "";
      if (this.form.errors.has("bidding_start")) {
        message += this.form.errors.get("bidding_start");
      }
      if (this.form.errors.has("bidding_end")) {
        message += this.form.errors.get("bidding_end");
      }
      return message;
    },
    dateErrors() {
      if (this.hasDateErrors) {
        return (
          this.form.errors.get("start_date") +
          "<br/> " +
          this.form.errors.get("end_date")
        );
      }
    },
    hasDateErrors() {
      return (
        this.form.errors.has("start_date") || this.form.errors.has("end_date")
      );
    },
    dateRange() {
      if (this.form.start_date && this.form.end_date) {
        return [
          this.dateFromMySql(this.form.start_date),
          this.dateFromMySql(this.form.end_date)
        ];
      } else {
        return [new Date(), new Date()];
      }
    },
    minDate() {
      var d = new Date();
      d.setHours(0, 0, 0, 0);
      return d;
    },
    biddingRange() {
      if (this.form.bidding_start && this.form.bidding_end) {
        return [
          this.dateFromMySql(this.form.bidding_start),
          this.dateFromMySql(this.form.bidding_end)
        ];
      } else {
        return [new Date(), new Date()];
      }
    },
    canDelete() {
      return this.userIs("admin");
    },
    ...mapGetters("defines", ["statesFor"]),
    ...mapGetters("auth", ["userIs"])
  },

  data() {
    return {
      activeTab: 0,
      timezone: null,
      enrollmentFormTemplates: [],
      form: new Form({
        name: null,
        key: this.conferenceKey,
        location: null,
        timezone_id: null,
        start_date: null,
        end_date: null,
        description: null,
        url_name: null,
        url: null,
        state_id: null,
        enrollment_form_id: null,
        volunteer_hours: null,
        volunteer_max: null,
        email_chair: null,
        bidding_enabled: null,
        bidding_start: null,
        bidding_end: null,
        created_at: null,
        updated_at: null
      }),
      isLoading: false
    };
  },

  created() {
    this.timezone = this.conference.timezone;
    this.form.fill(this.conference);
  },

  methods: {
    updateBiddingRange: function($event) {
      this.form.bidding_start = $event[0].toMySqlDate();
      this.form.bidding_end = $event[1].toMySqlDate();
    },
    updateDateRange: function($event) {
      this.form.start_date = $event[0].toMySqlDate();
      this.form.end_date = $event[1].toMySqlDate();
    },
    save() {
      this.isLoading = true;
      api
        .updateConference(this.conference.key, this.form)
        .then(({ data }) => {
          this.$emit("updated", data.result);
          this.$buefy.toast.open({
            message: data.message,
            type: "is-success"
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    deleteConference() {
      this.$buefy.dialog.confirm({
        type: "is-danger",
        message: `Are your sure you want to delete ${this.conference.name}?`,
        onConfirm: () => {
          this.isLoading = true;
          api
            .deleteConference(this.conference.key)
            .then(() => this.$router.replace({ name: "conferences" }))
            .finally(() => (this.isLoading = false));
        }
      });
    }
  }
};
</script>