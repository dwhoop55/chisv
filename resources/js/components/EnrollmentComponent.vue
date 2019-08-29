<template>
  <div>
    <div v-if="errored">
      <b-notification type="is-warning" has-icon :closable="false">
        <p>Your enrollment status could not be loaded.</p>
        <p>{{ errored }}</p>
        <b-button outlined inverted type="is-warning" @click="getState();getCan()">Try again</b-button>
      </b-notification>
    </div>
    <div v-else-if="state">
      <b-notification :type="type" has-icon :closable="false">
        <p>
          You are
          <b-tooltip type="is-light" multilined :label="state.description">
            <strong>{{ state.name }}</strong>
          </b-tooltip>
        </p>
        <b-button
          v-if="canUnenroll"
          class="has-margin-t-7"
          outlined
          inverted
          type="is-danger"
          @click="unenroll"
        >Unenroll from {{conference.key}}</b-button>
      </b-notification>
    </div>
    <div v-else-if="unenrolled">
      <b-notification type="is-info" has-icon :closable="false">
        <p>You are not enrolled for this conference</p>
        <b-button
          v-if="canEnroll"
          class="has-margin-t-7"
          outlined
          inverted
          type="is-success"
          @click="enroll"
        >Enroll for {{conference.key}}</b-button>
      </b-notification>
    </div>
    <div v-else>
      <b-notification has-icon :closable="false">
        <p>Loading enrollment status..</p>
        <b-loading :is-full-page="false" :active="loading"></b-loading>
      </b-notification>
    </div>
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";

export default {
  props: ["conference"],

  data() {
    return {
      state: null,
      unenrolled: null,
      errored: null,
      loading: true,
      canUnenroll: false,
      canEnroll: false
    };
  },

  created() {
    this.getCan();
    this.getState();
  },

  methods: {
    unenroll: function() {
      // We warn the user and want a confirmation
      // when re-enrollment isnt possible after the user unenrolled
      if (this.conference.state.name != "enrollment") {
        this.$buefy.dialog.confirm({
          title: "Caution!",
          message:
            "The current state of the conference <b>will not allow for re-enrollment</b>! Are you sure you want to unenroll?",
          confirmText: "Yes, unenroll me",
          type: "is-danger",
          hasIcon: true,
          onConfirm: () => this.updateEnrollment("unenroll")
        });
      } else {
        this.updateEnrollment("unenroll");
      }
    },
    enroll: function() {
      this.updateEnrollment("enroll");
    },
    updateEnrollment: function(action) {
      api
        .updateEnrollment(action, this.conference.key)
        .then(data => {
          this.getState();
          this.getCan();
        })
        .catch(error => {
          this.errored = error.message;
        });
    },
    getState: function() {
      this.loading = true;
      this.errored = null;
      this.unenrolled = null;
      this.state = null;
      api
        .getEnrollment(this.conference.key)
        .then(data => {
          if (data.data == "") {
            this.unenrolled = true;
          } else {
            this.state = data.data;
          }
        })
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.loading = false;
        });
    },
    getCan: async function() {
      this.canEnroll = await auth.can(
        "enroll",
        "Conference",
        this.conference.id
      );

      this.canUnenroll = await auth.can(
        "unenroll",
        "Conference",
        this.conference.id
      );
    }
  },

  computed: {
    type: function() {
      switch (this.state.name) {
        case "accepted":
          return "is-success";
          break;
        case "enrolled":
          return "is-success";
          break;
        case "waitlisted":
          return "is-warning";
          break;
        case "dropped":
          return "is-danger";
          break;
      }
    }
  }
};
</script>
