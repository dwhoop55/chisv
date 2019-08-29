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
      <b-notification v-if="!loading && !state" type="is-info" has-icon :closable="false">
        You are not enrolled in this conference
        <p v-if="conference.state.name != 'enrollment'">
          The enrollment phase is
          <b>over</b>
        </p>
      </b-notification>
    </transition>

    <!-- Enrolled, Accepted, Waitlisted or Dropped -->
    <transition name="slide-top-fade">
      <b-notification v-if="!loading && state" :type="stateType(state)" has-icon :closable="false">
        <p>
          You are
          <b-tooltip type="is-light" multilined :label="state.description">
            <strong>{{ state.name }}</strong>
          </b-tooltip>
        </p>
        <p v-if="!loading && canUnenroll==false">You can no longer unenroll</p>
      </b-notification>
    </transition>

    <!-- Unenroll -->
    <transition name="slide-top-fade">
      <b-field grouped position="is-centered">
        <b-button
          v-if="!loading && canUnenroll"
          type="is-danger"
          icon-left="account-remove"
          @click="confirmUnenroll"
        >Unenroll</b-button>
      </b-field>
    </transition>

    <!-- Enroll form -->
    <transition name="slide-top-fade">
      <b-collapse
        :open="formOpenState"
        v-if="!loading && canEnroll && !state"
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
              <b-tooltip
                multilined
                label="If you get selected as a local volunteer
               you may be requested to do specific tasks that leverage 
               that characteristic, like finding restaurants, helping
               with the Information desk, help with PC meeting, and others."
              >
                <b-icon icon="information"></b-icon>&nbsp;
                <p
                  class="has-text-weight-medium"
                >{{ `Are you local to where ${conference.key.toUpperCase()} will be this year?` }}</p>
              </b-tooltip>
              <b-field class="has-margin-b-5">
                <b-switch
                  class="has-margin-l-3 has-margin-t-7"
                  type="is-success"
                  v-model="form.know_city"
                >{{ form.know_city ? 'Yes' : 'No' }}</b-switch>
              </b-field>

              <span class="has-text-weight-medium">
                Have you
                <b>attended</b> this conference before?
              </span>
              <b-field class="has-margin-b-5">
                <b-switch
                  class="has-margin-l-3 has-margin-t-7"
                  type="is-success"
                  v-model="form.attended_before"
                >{{ form.attended_before ? 'Yes' : 'No' }}</b-switch>
              </b-field>

              <span class="has-text-weight-medium">
                Have you been an
                <b>SV</b> at this conference before?
              </span>
              <b-field class="has-margin-b-5">
                <b-switch
                  class="has-margin-l-3 has-margin-t-7"
                  type="is-success"
                  v-model="form.sved_before"
                >{{ form.sved_before ? 'Yes' : 'No' }}</b-switch>
              </b-field>

              <b-tooltip
                multilined
                label="Choosing 'yes' will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs."
              >
                <b-icon icon="information"></b-icon>&nbsp;
                <p class="has-text-weight-medium">
                  Do you need to apply for a travel visa in order to attend this conference?
                  <br />(answer no if you are eligible for a VISA waiver program for the country of the conference)
                </p>
              </b-tooltip>
              <b-field class="has-margin-b-5">
                <b-switch
                  class="has-margin-l-3 has-margin-t-7"
                  type="is-success"
                  v-model="form.need_visa"
                >{{ form.need_visa ? 'Yes' : 'No' }}</b-switch>
              </b-field>

              <span
                class="has-text-weight-medium"
              >Please explain why you want to be an SV at the conference.</span>
              <b-field
                class="has-margin-b-5"
                :type="{ 'is-danger': form.errors.has('why') }"
                :message="form.errors.get('why')"
              >
                <b-input
                  maxlength="2000"
                  type="textarea"
                  class="has-margin-l-3 has-margin-t-7"
                  v-model="form.why"
                ></b-input>
              </b-field>

              <div class="notification" v-if="conference.enrollment_info">
                <span v-dompurify-html="conference.enrollment_info"></span>
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

    <!-- <div v-if="errored">
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
        <p v-else>You can no longer unenroll</p>
      </b-notification>
    </div>

    <div v-else-if="unenrolled">
      <b-notification type="is-info" has-icon :closable="false">
        <p>You are not enrolled in this conference</p>
        <b-button
          size="is-large"
          v-if="canEnroll"
          class="has-margin-t-7"
          outlined
          inverted
          type="is-success"
          @click="enroll"
          icon-left="github-circle"
        >Enroll</b-button>
        <p v-else>The enrollment phase is over!</p>
      </b-notification>
    </div>

    <div v-else>
      <b-notification has-icon :closable="false">
        <p>Loading enrollment status..</p>
        <b-loading :is-full-page="false" :active="loading"></b-loading>
      </b-notification>
    </div>-->
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
        attend_before: false,
        sved_before: false,
        need_visa: false,
        why: ""
      }),
      formOpenState: false,
      state: null,
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
      api
        .unenroll(this.conference.key)
        .then(data => {})
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.getState();
          this.getCan();
        });
    },
    enroll: function() {
      api
        .enroll(this.conference.key, this.form)
        .then(data => {})
        .catch(error => {
          this.errored = error.message;
        })
        .finally(() => {
          this.getState();
          this.getCan();
        });
    },
    getState: function() {
      this.loading = true;
      this.errored = null;
      this.state = null;
      api
        .getEnrollment(this.conference.key)
        .then(data => {
          if (data.data != "") {
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
  }
};
</script>
