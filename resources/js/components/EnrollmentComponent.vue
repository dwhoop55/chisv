<template>
  <div class="is-relative">
    <!-- Loading -->
    <b-loading :is-full-page="false" :active="isLoading"></b-loading>

    <!-- Not enrolled -->
    <div class="has-text-centered">
      <p class="is-size-4 has-margin-b-6" v-if="!permission">You are not enrolled in this conference</p>
      <p v-if="conference.state.name != 'enrollment'">
        The enrollment phase is
        <strong class="is-size-5 has-text-danger">over</strong>
      </p>
    </div>

    <!-- Enrolled, Accepted, Waitlisted or Dropped -->
    <div v-if="permission" class="has-text-centered">
      <div>
        <div class="is-size-4 has-margin-b-6">
          <p>
            You are
            <b-tooltip
              multilined
              :type="stateType(permission.state)"
              :label="permission.state.description"
            >
              <strong :class="classForStateName">{{ permission.state.name }}</strong>
            </b-tooltip>
            <span
              v-if="waitlistedWithPosition"
            >on position {{ permission.waitlist_position.position }}</span>
          </p>
          <p
            v-if="waitlistedWithPosition"
            class="is-size-6"
          >{{ waitlistTotal }} other {{ waitlistTotal === 1 ? 'SV is' : 'SVs are'}} waiting</p>
        </div>
        <p v-if="!canUnenroll">You can no longer unenroll</p>
      </div>
      <div>
        <b-button
          v-if="permission && permission.enrollment_form"
          class="has-margin-t-7"
          icon-left="format-list-bulleted"
          @click="showModal()"
        >Show form</b-button>

        <!-- Unenroll -->
        <b-button
          v-if="canUnenroll"
          type="is-danger"
          class="has-margin-t-7"
          icon-left="account-remove"
          @click="confirmUnenroll()"
        >Unenroll</b-button>
      </div>
    </div>

    <!-- Enroll form -->
    <transition name="slide-top-fade">
      <b-collapse
        :open="true"
        v-if="canEnroll && !permission"
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
              <p>You may adjust these fields from your profile right here</p>
              <past-conferences-component></past-conferences-component>
              <hr />
              <enrollment-form v-if="form" v-model="form"></enrollment-form>
              <p class="notification is-warning" v-if="form && form.agreement">{{ form.agreement }}</p>
            </div>
          </div>
          <footer class="card-footer">
            <a
              :disabled="form && form.vform && form.vform.busy"
              @click="enroll"
              class="card-footer-item is-success"
            >{{ form && form.agreement ? 'Agree and ' : ''}}Enroll</a>
          </footer>
        </form>
      </b-collapse>
    </transition>
  </div>
</template>

<script>
import api from "@/api.js";
import Form from "vform";
import { mapGetters, mapActions } from "vuex";
import EnrollmentFormModal from "./../components/modals/EnrollmentFormModal";

export default {
  props: ["conference"],

  data() {
    return {
      form: null,
      isLoading: false
    };
  },

  created() {
    this.form = this.parseEnrollmentForm(
      this.conference.enrollment_form_template
    );
  },

  methods: {
    showModal() {
      this.$buefy.modal.open({
        parent: this,
        component: EnrollmentFormModal,
        props: {
          form: this.parseEnrollmentForm(this.permission.enrollment_form)
        },
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
        .catch(error => console.log(error))
        .finally(() => {
          this.isLoading = false;
          this.fetchUser();
        });
    },

    enroll: function() {
      this.isLoading = true;
      api
        .enroll(this.conference.key, this.form.vform)
        .catch(error => console.log(error))
        .finally(() => {
          this.isLoading = false;
          this.fetchUser();
        });
    },
    ...mapActions("auth", ["fetchUser"])
  },

  computed: {
    waitlistTotal() {
      return (
        this.permission.waitlist_position.post +
        this.permission.waitlist_position.pre
      );
    },
    waitlistedWithPosition() {
      return (
        this.permission.state.name == "waitlisted" &&
        this.permission.waitlist_position
      );
    },
    classForStateName() {
      if (this.permission.state.name != "enrolled") {
        return this.stateType(this.permission.state).replace(
          "is-",
          "has-text-"
        );
      }
    },
    // Get the sv permission for the given conference
    permission() {
      var result = null;
      this.user.permissions.forEach(permission => {
        if (
          permission.conference?.id == this.conference.id &&
          permission.role?.name == "sv"
        ) {
          result = permission;
        }
      });
      return result;
    },
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
    ...mapGetters("auth", ["user", "userIs"])
  }
};
</script>
