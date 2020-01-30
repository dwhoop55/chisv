<template>
  <div>
    <div
      @click="showHint('successful-not-assigned')"
      class="button is-small"
      v-if="bidIsPresent && bidIsStateSuccessful && !assignmentIsPresent"
    >
      <b-icon type="is-light" icon="account-question" />
      <span>&nbsp;Bid won, not assigned</span>
    </div>

    <div
      @click="showHint('unsuccessful')"
      class="button is-small"
      v-if="bidIsPresent && bidIsStateUnsuccessful && !assignmentIsPresent"
    >
      <b-icon type="is-light" icon="account-off" />
      <span>&nbsp;Bid negative</span>
    </div>

    <div @click="showHint('assigned')" class="button is-small" v-if="assignmentIsStateAssigned">
      <b-icon type="is-warning" icon="account" />
      <span>&nbsp;Scheduled</span>
    </div>

    <div @click="showHint('checked-in')" class="button is-small" v-if="assignmentIsStateCheckedIn">
      <b-icon type="is-warning" icon="account-clock" />
      <span>&nbsp;Checked-in</span>
    </div>

    <div @click="showHint('done')" class="button is-small" v-if="assignmentIsStateDone">
      <b-icon type="is-success" icon="account-heart" />
      <span>&nbsp;Done</span>
    </div>

    <b-field
      v-if="(bidIsStatePlaced || !bidIsPresent) && !assignmentIsPresent"
      @click.native="showHint('disabled')"
      class="is-relative"
    >
      <b-radio-button
        @input="setPreference($event)"
        :value="task.own_bid.preference"
        :disabled="disabled"
        :size="size"
        type="is-danger"
        :native-value="parseInt(0)"
      >X</b-radio-button>
      <b-radio-button
        @input="setPreference($event)"
        :value="task.own_bid.preference"
        :disabled="disabled"
        :size="size"
        type="is-info"
        :native-value="parseInt(1)"
      >1</b-radio-button>
      <b-radio-button
        @input="setPreference($event)"
        :value="task.own_bid.preference"
        :disabled="disabled"
        :size="size"
        type="is-warning"
        :native-value="parseInt(2)"
      >2</b-radio-button>
      <b-radio-button
        @input="setPreference($event)"
        :value="task.own_bid.preference"
        :disabled="disabled"
        :size="size"
        type="is-success"
        :native-value="parseInt(3)"
      >3</b-radio-button>
      <b-loading :is-full-page="false" :active="isLoading"></b-loading>
      <transition name="slide-top-fade">
        <b-icon class="has-margin-l-7" v-if="showSuccessIcon" type="is-success" icon="check-bold"></b-icon>
      </transition>
      <transition name="slide-top-fade">
        <b-icon class="has-margin-l-7" v-if="showErrorIcon" type="is-danger" icon="alert"></b-icon>
      </transition>
    </b-field>
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
    setPreference(value) {
      this.isLoading = true;
      let bid = this.task.own_bid;
      bid.preference = parseInt(value);

      if (bid.id) {
        // Existing bid, update only
        api
          .updateBid(this.buildBid(bid))
          .then(data => {
            this.showSuccess();
            this.$emit("input", this.task);
          })
          .catch(error => {
            this.showError();
            this.$emit("error");
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        // New bid, create new
        api
          .createBid(this.buildBid(bid))
          .then(data => {
            this.showSuccess();
            this.task.own_bid = data.data;
            this.$emit("input", this.task);
          })
          .catch(error => {
            this.showError();
            this.$emit("error");
          })
          .finally(() => {
            this.isLoading = false;
          });
      }
    },
    buildBid(bid) {
      // Build the bid we send to the backend
      // for an update we only need the id and preferences
      // for a new bid (create) we only need the task_id
      // and preference. Instead of sending the entire bid
      // with all its attributes we minimize network usage
      // since this is something many SV will be doing on
      // the go
      var result = {
        preference: bid.preference
      };
      if (bid.id) {
        result.id = bid.id;
      } else {
        result.task_id = bid.task_id;
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
    formatPreference(task) {
      switch (task.own_bid.preference) {
        case 0:
          return "X";
          break;
        case 1:
        case 2:
        case 3:
          return task.own_bid.preference;
          break;
        default:
          return "You did not bid";
          break;
      }
    },
    showHint(type) {
      switch (type) {
        case "disabled":
          if (this.disabled) {
            this.$buefy.dialog.alert(
              "You cannot bid or change your bid at the moment. One of the reasons might be:\
            <li>Bidding is not open for this day</li>\
            <li>The task is in the past</li>\
            <li>You are not an SV with the state <i>accepted</i></li>\
            <li>You are already assigned to this task</li>"
            );
          }
          break;
        case "successful-not-assigned":
          this.$buefy.dialog.alert({
            title: `Your bid won - but..`,
            message: `Your bid won the auction. However you are not assigned to the task.\
              That can happen when there are necessary last-minute changes to the assignments.\
              So that the assignments are as fair as possible on average for everyone. Never mind though, you'll\
              get an awesome task soon for sure!\
              <br/><br/><small>Your bid: ${this.formatPreference(
                this.task
              )}</small>`,
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
            <li>Conflict with other task you're assigned to</li>\
            <li>Other SVs bid higher</li>\
            <li>You bid high but other SVs also bidding high have less total hours</li>\
            <br/><br/><small>Your bid: ${this.formatPreference(
              this.task
            )}</small>`,
            type: "is-dark",
            hasIcon: true,
            icon: "ice-cream",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "assigned":
          this.$buefy.dialog.alert({
            title: `This is your task`,
            message: `This task is assigned to you\
                      <br/><br/><small>Your bid: ${this.formatPreference(
                        this.task
                      )}<br/>\
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
                      <br/><br/><small>Your bid: ${this.formatPreference(
                        this.task
                      )}<br/>\
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
                      <br/><br/><small>Your bid:\
                      ${this.formatPreference(this.task)}<br/>\
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
    bidIsStatePlaced() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "placed"
      );
    },
    bidIsStateSuccessful() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "successful"
      );
    },
    bidIsStateUnsuccessful() {
      return (
        this.task.own_bid &&
        this.task.own_bid.state &&
        this.task.own_bid.state.name == "unsuccessful"
      );
    },
    bidIsPresent() {
      return this.task.own_bid && this.task.own_bid.state;
    },
    assignmentIsPresent() {
      return this.task.own_assignment && true;
    },
    assignmentIsStateAssigned() {
      return (
        this.task.own_assignment &&
        this.task.own_assignment.state.name == "assigned"
      );
    },
    assignmentIsStateCheckedIn() {
      return (
        this.task.own_assignment &&
        this.task.own_assignment.state.name == "checked-in"
      );
    },
    assignmentIsStateDone() {
      return (
        this.task.own_assignment &&
        this.task.own_assignment.state.name == "done"
      );
    }
  }
};
</script>