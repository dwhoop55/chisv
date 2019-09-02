<template>
  <div>
    <!-- Loading -->
    <b-notification v-if="loading" has-icon :closable="false">Loading enrollment status..</b-notification>

    <!-- Errored -->
    <transition name="slide-top-fade">
      <b-notification v-if="!loading && errored" type="is-warning" has-icon :closable="false">
        <p>Your enrollment status could not be loaded.</p>
        <p>{{ errored }}</p>
        <b-button outlined inverted type="is-warning" @click="getState();getCan()">Try again</b-button>
      </b-notification>
    </transition>

    <!-- Not enrolled -->
    <transition name="slide-top-fade">
      <b-notification v-if="!loading && !permission" type="is-light" has-icon :closable="false">
        You are not enrolled in this conference
        <p v-if="conference.state.name != 'enrollment'">
          The enrollment phase is
          <b>over</b>
        </p>
      </b-notification>
    </transition>

    <!-- Enrolled, Accepted, Waitlisted or Dropped -->
    <transition name="slide-top-fade">
      <b-notification
        v-if="!loading && permission"
        :type="stateType(permission.state)"
        has-icon
        :closable="false"
      >
        <p>
          You are
          <b-tooltip type="is-light" multilined :label="permission.state.description">
            <strong>{{ permission.state.name }}</strong>
          </b-tooltip>
        </p>
        <!-- Unenroll -->
        <transition name="slide-left-fade">
          <b-button
            v-if="!loading && canUnenroll"
            type="is-danger"
            class="has-margin-t-7"
            outlined
            inverted
            icon-left="account-remove"
            @click="confirmUnenroll"
          >Unenroll</b-button>
        </transition>
        <b-button
          v-if="!loading && permission"
          type="is-primary"
          class="has-margin-t-7"
          outlined
          inverted
          icon-left="format-list-bulleted"
          @click="showEnrollmentForm=true"
        >Show Enrollment Form</b-button>
        <p v-if="!loading && canUnenroll==false">You can no longer unenroll</p>
      </b-notification>
    </transition>

    <!-- Enroll form -->
    <transition name="slide-top-fade">
      <b-collapse
        :open="false"
        v-if="!loading && canEnroll && !permission"
        class="card"
        aria-id="contentIdForEnrollForm"
      >
        <div
          slot="trigger"
          slot-scope="props"
          class="card-header"
          role="button"
          aria-controls="contentIdForEnrollForm"
        >
          <p class="card-header-title">Enroll</p>
          <a class="card-header-icon">
            <b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon>
          </a>
        </div>
        <form @submit.prevent="enroll" @keydown="form.onKeydown($event)">
          <div class="card-content">
            <div class="content">
              <enrollment-form v-model="form" :conference="conference"></enrollment-form>

              <div class="notification" v-if="conference.enrollment_text">
                <span v-dompurify-html="conference.enrollment_text"></span>
              </div>
              <!-- end content -->
            </div>
          </div>
          <footer class="card-footer">
            <a @click="enroll" class="card-footer-item is-success">Agree and Enroll</a>
          </footer>
        </form>
      </b-collapse>
    </transition>

    <b-modal :active.sync="showEnrollmentForm" has-modal-card>
      <enrollment-form-modal v-model="form" disabled :conference="conference"></enrollment-form-modal>
    </b-modal>
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";
import Form from "vform";

export default {
  props: ["conference"],

  data() {
    return {
      form: new Form({
        know_city: false,
        attended_before: false,
        sved_before: false,
        need_visa: false,
        why: ""
      }),
      showEnrollmentForm: false,

      permission: null,
      errored: null,
      loading: true,

      canUnenroll: null,
      canEnroll: null
    };
  },

  created() {
    this.getCan();
    this.getState();
  },

  methods: {
    confirmUnenroll: function() {
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
          onConfirm: () => this.unenroll()
        });
      } else {
        this.unenroll();
      }
    },
    unenroll: function() {
      this.loading = true;
      api
        .unenroll(this.conference.key)
        .then(data => {
          this.errored = null;
          this.permission = null;
        })
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.getCan();
          this.loading = false;
        });
    },
    enroll: function() {
      this.loading = true;
      api
        .enroll(this.conference.key, this.form)
        .then(data => {
          this.permission = data.data.result;
          this.errored = null;
        })
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.getCan();
          this.loading = false;
        });
    },
    getState: function() {
      this.loading = true;
      this.errored = null;
      this.permission = null;
      api
        .getEnrollment(this.conference.key)
        .then(data => {
          if (data.data != "") {
            this.permission = data.data;
            this.form.fill(this.permission.enrollment_form);
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
  }
};
</script>
