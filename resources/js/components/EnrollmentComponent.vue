<template>
  <div>
    <!-- Loading -->
    <b-notification v-if="isLoading" has-icon :closable="false">Loading enrollment status..</b-notification>

    <!-- Errored -->
    <transition name="slide-top-fade">
      <b-notification v-if="!isLoading && errored" type="is-warning" has-icon :closable="false">
        <p>Your enrollment status could not be loaded.</p>
        <p>{{ errored }}</p>
        <b-button outlined inverted type="is-warning" @click="getState()">Try again</b-button>
      </b-notification>
    </transition>

    <!-- Not enrolled -->
    <transition name="slide-top-fade">
      <b-notification v-if="!isLoading && !permission" type="is-light" has-icon :closable="false">
        You are not enrolled in this conference
        <p v-if="conference.state.name != 'enrollment'">
          The enrollment phase is
          <b>over</b>
        </p>
      </b-notification>
    </transition>

    <!-- Enrolled, Accepted, Waitlisted or Dropped -->
    <b-notification
      v-if="!isLoading && permission"
      :type="stateType(permission.state)"
      has-icon
      :closable="false"
    >
      <p>
        You are
        <b-tooltip
          :type="stateType(permission.state)"
          multilined
          :label="permission.state.description"
        >
          <strong>{{ permission.state.name }}</strong>
          <p
            v-if="permission.state.name == 'waitlisted' && permission.waitlist_position"
          >&nbsp;on position {{ permission.waitlist_position.position }}</p>
        </b-tooltip>
      </p>
      <b-button
        v-if="!isLoading && permission && form"
        type="is-primary"
        class="has-margin-t-7"
        outlined
        icon-left="format-list-bulleted"
        @click="showModal"
      >Show Enrollment Form</b-button>
      <!-- Unenroll -->
      <b-button
        v-if="!isLoading && canUnenroll"
        type="is-danger"
        class="has-margin-t-7"
        outlined
        icon-left="account-remove"
        @click="confirmUnenroll"
      >Unenroll</b-button>

      <p v-if="!isLoading && !canUnenroll">You can no longer unenroll</p>
    </b-notification>

    <!-- Enroll form -->
    <transition name="slide-top-fade">
      <b-collapse
        :open="true"
        v-if="!isLoading && canEnroll && !permission"
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
        <form @submit.prevent="enroll">
          <div class="card-content">
            <div class="content">
              <enrollment-form v-if="form" v-model="form"></enrollment-form>
              <p class="notification is-warning" v-if="form && form.agreement">{{ form.agreement }}</p>
            </div>
          </div>
          <footer class="card-footer">
            <a
              :disabled="form && form.vform && form.vform.busy"
              @click="enroll"
              class="card-footer-item is-success"
            >Agree and Enroll</a>
          </footer>
        </form>
      </b-collapse>
    </transition>
  </div>
</template>

<script>
import api from "@/api.js";
import Form from "vform";
import { mapGetters } from "vuex";
import EnrollmentFormModal from "./../components/modals/EnrollmentFormModal";

export default {
  props: ["conference"],

  data() {
    return {
      form: null,
      permission: null,
      errored: null,
      isLoading: true
    };
  },

  created() {
    this.getState();
  },

  methods: {
    showModal() {
      this.$buefy.modal.open({
        parent: this,
        component: EnrollmentFormModal,
        props: { value: this.form },
        hasModalCard: true,
        trapFocus: true
      });
    },
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
      this.isLoading = true;
      api
        .unenroll(this.conference.key)
        .then(data => {
          this.errored = null;
          this.permission = null;
          this.$emit("update", "unenrolled");
        })
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.getState();
          this.isLoading = false;
        });
    },

    enroll: function() {
      this.isLoading = true;
      api
        .enroll(this.conference.key, this.form.vform)
        .then(data => {
          this.permission = data.data.result;
          this.errored = null;
          this.$emit("update", "enrolled");
        })
        .catch(error => {
          if (error.response.status != 422) {
            this.errored = error.message;
          }
        })
        .finally(() => {
          this.getState();
          this.isLoading = false;
        });
    },

    getState: function() {
      this.isLoading = true;
      this.errored = null;
      this.permission = null;

      api
        .getEnrollment(this.conference.key)
        .then(data => {
          let response = data.data;
          if (response.permission) {
            // User is enrolled
            this.permission = response.permission;
            // If there is an enrollment form, load it
            if (response.permission.enrollment_form) {
              this.form = this.parseEnrollmentForm(
                response.permission.enrollment_form
              );
            } else {
              // There is no enrollment form
              this.form = null;
            }
          } else if (response.enrollment_form) {
            // User is not enrolled (missing permission)
            // so we got the enrollment form template
            this.form = this.parseEnrollmentForm(response.enrollment_form);
          }
        })
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  },

  computed: {
    canEnroll() {
      if (
        !this.userIs("sv", this.conference.key) &&
        this.conference.state.name === "enrollment"
      ) {
        return true;
      } else {
        return false;
      }
    },
    canUnenroll() {
      if (
        !this.userIs("sv", this.conference.key, "dropped") &&
        this.conference.state.name != "over"
      ) {
        return true;
      } else {
        return false;
      }
    },
    ...mapGetters("auth", ["userIs"])
  }
};
</script>
