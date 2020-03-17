<template>
  <div class="is-flex">
    <!-- WE HAVE AN ASSIGNMENT -->
    <div v-if="hasAssignment">
      <div @click="showHint('assigned')" class="button is-small" v-if="isAssigned">
        <b-icon type="is-warning" icon="account" />
        <span>&nbsp;Scheduled</span>
      </div>

      <div @click="showHint('checked-in')" class="button is-small" v-if="isCheckedIn">
        <b-icon type="is-warning" icon="account-clock" />
        <span>&nbsp;Checked-in</span>
      </div>

      <div @click="showHint('done')" class="button is-small" v-if="isDone">
        <b-icon type="is-success" icon="account-heart" />
        <span>&nbsp;Done</span>
      </div>
    </div>

    <!-- WE HAVE A BID -->
    <div v-else-if="hasBid">
      <div class="is-relative" v-if="task.own_bid.can_update">
        <!-- Can update existing bid -->
        <b-loading :is-full-page="false" :active="isLoading"></b-loading>
        <task-bid-picker-radio
          @input="setPreference($event)"
          :value="task.own_bid.preference"
          :disabled="isLoading"
          :size="size"
        />
      </div>
      <div v-else>
        <!-- Cannot update existing bid -->
        <div v-if="isSuccessful">
          <!-- Bid won but not assigned -->
          <div @click="showHint('successful-not-assigned')" class="button is-small">
            <b-icon type="is-light" icon="account-question" />
            <span>&nbsp;Not assigned</span>
          </div>
        </div>
        <div v-else-if="isUnsuccessful">
          <!-- Bid lost, not assigned -->
          <div @click="showHint('unsuccessful')" class="button is-small">
            <b-icon type="is-light" icon="account-off" />
            <span>&nbsp;Not assigned</span>
          </div>
        </div>
        <div v-else-if="isConflict">
          <!-- Bid conflicting, not assigned -->
          <div @click="showHint('conflict')" class="button is-small">
            <b-icon type="is-light" icon="timeline-alert-outline" />
            <span>&nbsp;Time conflict</span>
          </div>
        </div>
        <div v-else>
          <!-- Bid is placed and was not evaluated
          Bid chaning is not possible-->
          <task-bid-picker-radio
            @click.native="showHint('disabled')"
            :value="task.own_bid.preference"
            :disabled="true"
            :size="size"
          />
        </div>
      </div>
    </div>

    <!-- WE HAVE NO BID AND NO ASSIGNMENT BUT CAN CREATE -->
    <div class="is-relative" v-else-if="task.can_create_bid">
      <!-- Has no bid yet but can create one -->
      <b-loading :is-full-page="false" :active="isLoading" />
      <task-bid-picker-radio
        @input="setPreference($event)"
        :value="null"
        :size="size"
        :disabled="isLoading"
      />
    </div>

    <!-- NO BID, NO ASSIGNMENT, NOT ABLE TO CREATE -->
    <div v-else>
      <a @click.prevent="showHint('disabled')">
        <b-icon type="is-grey" icon="cancel" :size="size" />
        <span class="has-text-grey">Not bidable</span>
      </a>
    </div>

    <div>
      <transition name="slide-top-fade">
        <b-icon class="has-margin-l-7" v-if="showSuccessIcon" type="is-success" icon="check-bold"></b-icon>
      </transition>
      <transition name="slide-top-fade">
        <b-icon class="has-margin-l-7" v-if="showErrorIcon" type="is-danger" icon="alert"></b-icon>
      </transition>
    </div>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["task", "size"],

  model: {
    prop: "task"
  },

  data() {
    return {
      isLoading: false,
      showSuccessIcon: false,
      showErrorIcon: false
    };
  },

  methods: {
    setPreference(preference) {
      this.isLoading = true;
      let bid = this.buildBid(preference);

      if (bid.id) {
        // Existing bid, update or delete
        if (preference != undefined) {
          // Update
          api
            .updateBid(this.buildBid(preference))
            .then(data => {
              this.showSuccess();
              let task = this.task;
              task.own_bid = data.data.result;
              this.$emit("input", task);
            })
            .catch(error => {
              this.showError();
              this.$emit("error");
            })
            .finally(() => (this.isLoading = false));
        } else {
          // Preference removed, delete bid
          api
            .deleteBid(bid.id)
            .then(data => {
              this.showSuccess();
              let task = this.task;
              task.own_bid = null;
              task.can_create_bid = true;
              this.$emit("input", task);
            })
            .catch(error => {
              this.showError();
              this.$emit("error");
            })
            .finally(() => (this.isLoading = false));
        }
      } else {
        // New bid, create new
        api
          .createBid(this.buildBid(preference))
          .then(data => {
            this.showSuccess();
            let task = this.task;
            task.can_create_bid = false;
            task.own_bid = data.data.result;
            this.$emit("input", task);
            this.$forceUpdate();
          })
          .catch(error => {
            this.showError();
            this.$emit("error");
          })
          .finally(() => (this.isLoading = false));
      }
    },
    buildBid(preference) {
      // Build the bid we send to the backend
      // for an update we only need the id and preferences
      // for a new bid (create) we only need the task_id
      // and preference. Instead of sending the entire bid
      // with all its attributes we minimize network usage
      // since this is something many SV will be doing on
      // the go (see study)
      var result = {
        preference: preference
      };
      if (this.task.own_bid && this.task.own_bid.id) {
        result.id = this.task.own_bid.id;
      } else {
        result.task_id = this.task.id;
      }

      return result;
    },
    showSuccess() {
      this.showSuccessIcon = true;
      setTimeout(() => {
        this.showSuccessIcon = false;
      }, 800);
    },
    showError() {
      this.showErrorIcon = true;
      setTimeout(() => {
        this.showErrorIcon = false;
      }, 2000);
    },
    formatPreference() {
      if (this.task.own_bid && this.task.own_bid.preference) {
        return this.preferenceString(this.task.own_bid.preference);
      } else {
        return "none";
      }
    },
    showHint(type) {
      switch (type) {
        case "disabled":
          if (this.disabled) {
            this.$buefy.dialog.alert({
              message:
                "You cannot bid or change your bid at the moment. One of the reasons might be:\
            <li>Bidding is not open for this day</li>\
            <li>You are not an SV with the state <i>accepted</i></li>\
            <li>You are already assigned to this task</li>"
            });
          }
          break;
        case "successful-not-assigned":
          this.$buefy.dialog.alert({
            title: `Your bid won - but..`,
            message: `Your bid won the auction. However you are not assigned to the task.\
              That can happen when there are necessary last-minute changes to the assignments.\
              So that the assignments are as fair as possible on average for everyone. Never mind though, you'll\
              get an awesome task soon for sure!\
              <br/><br/><small>Your submitted preference: ${this.formatPreference()}</small>`,
            type: "is-dark",
            hasIcon: true,
            icon: "cat",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "unsuccessful":
          this.$buefy.dialog.alert({
            title: `Your bid did not win`,
            message: `This task was not assigned to you<br>
            One of the reasons might be:\
            <li>Other SVs bid higher</li>\
            <li>You bid high but other SVs also bidding high have less total hours</li>\
            <br/><br/><small>Your submitted preference: ${this.formatPreference()}</small>`,
            type: "is-dark",
            hasIcon: true,
            icon: "ice-cream",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "conflict":
          this.$buefy.dialog.alert({
            title: `Time conflict`,
            message: `This task was not assigned to you because it is conflicting\
            with another's task time slot. 
            <br/><br/><small>Your submitted preference: ${this.formatPreference()}</small>`,
            type: "is-dark",
            hasIcon: true,
            icon: "timeline-alert-outline",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "assigned":
          this.$buefy.dialog.alert({
            title: `This is your task`,
            message: `This task is assigned to you\
                      <br/><br/><small>Your submitted preference: ${this.formatPreference()}<br/>\
                      You will get ${this.hoursFromTime(
                        this.timeFromDecimal(this.task.own_assignment.hours)
                      )} hours</small>`,
            type: "is-primary",
            hasIcon: true,
            icon: "check",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "checked-in":
          this.$buefy.dialog.alert({
            title: `In progress..`,
            message: `You are currently working on this task. Please let the Day Captain known when you're done and leave\
                      <br/><br/><small>Your submitted preference: ${this.formatPreference()}<br/>\
                      You will get ${this.hoursFromTime(
                        this.timeFromDecimal(this.task.own_assignment.hours)
                      )} hours</small>`,
            type: "is-warning",
            hasIcon: true,
            icon: "clock",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "done":
          this.$buefy.dialog.alert({
            title: `You're awesome!`,
            message: `This task is done.<br/>Thank you!\
                      <br/><br/><small>Your submitted preference:\
                      ${this.formatPreference()}<br/>\
                      Got got ${this.hoursFromTime(
                        this.timeFromDecimal(this.task.own_assignment.hours)
                      )} hours</small>`,
            type: "is-danger",
            hasIcon: true,
            icon: "heart",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
      }
    }
  },

  computed: {
    preference() {
      return this.task && this.task.own_bid && this.task.own_bid.preference
        ? this.task.own_bid.preference
        : null;
    },
    disabled() {
      if (this.isLoading) {
        return true;
      } else if (this.task.can_create_bid) {
        return false;
      } else if (this.task.own_bid && this.task.own_bid.can_update) {
        return false;
      } else {
        return true;
      }
    },
    hasBid() {
      return this.task.own_bid && this.task.own_bid.id && true;
    },
    hasAssignment() {
      return this.task.own_assignment && this.task.own_assignment.id && true;
    },
    isPlaced() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "placed"
      );
    },
    isSuccessful() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "successful"
      );
    },
    isUnsuccessful() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "unsuccessful"
      );
    },
    isConflict() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "conflict"
      );
    },
    isAssigned() {
      return (
        this.task.own_assignment &&
        this.task.own_assignment.state.name == "assigned"
      );
    },
    isCheckedIn() {
      return (
        this.task.own_assignment &&
        this.task.own_assignment.state.name == "checked-in"
      );
    },
    isDone() {
      return (
        this.task.own_assignment &&
        this.task.own_assignment.state.name == "done"
      );
    }
  }
};
</script>