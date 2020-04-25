<template>
  <div>
    <b-field v-if="userIs('admin') || userIs('chair') || userIs('captain')">
      <b-switch
        :value="showWaitlistPosition"
        @input="setShowWaitlistPosition"
      >Show waitlist position on SV state toggle in the SV view</b-switch>
    </b-field>
    <b-field v-if="userIs('admin') || userIs('chair') || userIs('captain')">
      <b-switch
        :value="showAssignmentsAvatar"
        @input="setShowAssignmentsAvatar"
      >Show image for SVs on assignments tab</b-switch>
    </b-field>
    <b-field>
      <b-switch :value="showSvAvatar" @input="setShowSvAvatar">Show image for SVs on SV tab</b-switch>
    </b-field>
    <b-field>
      <b-switch
        :value="warnBeforeMultiBid"
        @input="setWarnBeforeMultiBid"
      >Warn before sending off a multi-bid</b-switch>
    </b-field>
    <!-- <b-field>
      <b-button type="is-danger" @click="removeUiPreferences()">Reset all UI preferences</b-button>
    </b-field>-->
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
  data() {
    return {};
  },

  created() {},

  methods: {
    removeUiPreferences() {
      // First we remove the persistens backup of the in-memory
      // vuex store
      this.$buefy.dialog.confirm({
        title: "Reset all frontend preferences",
        message:
          "Your browser's local storage keeps a record of the state of the interface.\
                  We save (among others) your current tab in a conference or other menu, what\
                  you've searched for or on which date your viewing tasks. This is all kept locally\
                  in your browser cache.\
                  In case you got new permissions granted or encounter an issue with the UI please reset\
                  your local preferences cache by continuing. If you are just exploring the interface\
                  you might as well press 'No' below.",
        cancelText: "No, keep as is",
        confirmText: "Yes, purge frontend UI preferences",
        onConfirm: () => {
          this.resetStore();
          this.$buefy.notification.open({
            duration: 5000,
            message: `Preferences reset`,
            type: "is-success",
            hasIcon: true
          });
          // This will actually reset the vuex store in memory
          window.location.href = "/";
        }
      });
    },
    ...mapActions("auth", {
      resetStore: "resetStore"
    }),
    ...mapMutations("svs", ["setShowWaitlistPosition", "setShowSvAvatar"]),
    ...mapMutations("tasks", ["setWarnBeforeMultiBid"]),
    ...mapMutations("assignments", ["setShowAssignmentsAvatar"])
  },

  computed: {
    ...mapGetters("svs", ["showWaitlistPosition", "showSvAvatar"]),
    ...mapGetters("assignments", ["showAssignmentsAvatar"]),
    ...mapGetters("tasks", ["warnBeforeMultiBid"]),
    ...mapGetters("auth", ["userIs"])
  }
};
</script>
