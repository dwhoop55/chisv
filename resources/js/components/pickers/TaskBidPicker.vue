<template>
  <div>
    <div
      @click="showHint('successful')"
      class="button is-small"
      v-if="bidIsPresent && bidIsStateSuccessful"
    >
      <b-icon type="is-success" icon="account-check" />
      <span>your task!</span>
    </div>

    <div
      @click="showHint('unsuccessful')"
      class="button is-small"
      v-if="bidIsPresent && bidIsStateUnsuccessful"
    >
      <b-icon type="is-warning" icon="account-off" />
      <span>not assigned</span>
    </div>

    <b-field
      v-if="bidIsStatePlaced || !bidIsPresent"
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
    showHint(type) {
      switch (type) {
        case "disabled":
          if (this.disabled) {
            this.$buefy.dialog.alert(
              "You cannot bid or change your bid at the moment. One of the reasons might be:\
            <li>Bidding is not open for this day</li>\
            <li>The task is in the past</li>\
            <li>You are not an SV with the state <i>accepted</i></li>"
            );
          }
          break;
        case "successful":
          this.$buefy.dialog.alert({
            title: `Your bid won!`,
            message:
              "This task is now assigned to you. Please be there in time.",
            type: "is-success",
            hasIcon: true,
            icon: "check",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
        case "unsuccessful":
          this.$buefy.dialog.alert({
            title: `Your bid did not win`,
            message:
              "This task was not assigned to you - So a different SV will take care of this :)",
            type: "is-warning",
            hasIcon: true,
            icon: "emoticon-sad",
            ariaRole: "alertdialog",
            ariaModal: true
          });
          break;
      }
    }
  },

  computed: {
    preference() {
      return this.task && this.task.own_bid
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
    }
  }
};
</script>