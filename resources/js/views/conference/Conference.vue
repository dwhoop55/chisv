<template>
  <div>
    <b-loading :active="isLoading"></b-loading>
    <div>
      <div
        class="is-fixed is-100hw is-100vh is-pinned-l is-pinned-t is-cover is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(conference)"
      ></div>

      <transition name="fade">
        <div v-if="!isLoading && conference" class="columns is-centered">
          <div class="column is-11">
            <nav class="level">
              <div class="level-left">
                <div class="level-item">
                  <figure class="image is-48x48">
                    <img :src="conferenceIcon(conference)" />
                  </figure>
                </div>
                <div class="level-item">
                  <p
                    class="is-size-3 has-text-black-bis has-text-weight-bold"
                  >{{ conference.name | textlimit(50) }}</p>
                </div>
                <div class="level-item">
                  <b-taglist attached>
                    <state-tag size="is-medium" :state="conference.state"></state-tag>
                    <b-tag
                      rounded
                      size="is-medium"
                      v-if="conference.bidding_enabled"
                      type="is-success"
                    >Bidding now open!</b-tag>
                    <b-tag
                      rounded
                      size="is-medium"
                      v-else
                      type="is-warning"
                    >Bidding currently closed</b-tag>
                  </b-taglist>
                </div>
              </div>
            </nav>

            <div class="card has-padding-5">
              <nav class="level">
                <div class="level-left">
                  <div class="level-item is-block">
                    <p class="has-text-weight-medium">
                      {{ conference.location }}
                      |
                      {{ formatTime(conference.start_date, "ll", {fromTz: conference.timezone.name, toTz: conference.timezone.name}) }}
                      –
                      {{ formatTime(conference.end_date, "ll", {fromTz: conference.timezone.name, toTz: conference.timezone.name}) }}
                    </p>
                    <a
                      v-if="conference.email_chair"
                      class="has-text-weight-medium"
                      :href="'mailto:' + conference.email_chair"
                    >{{ conference.email_chair }}</a>
                  </div>
                </div>
                <div class="level-right">
                  <div class="level-item">
                    <div class="buttons">
                      <a
                        class="button is-primary has-margin-l-6"
                        target="_blank"
                        v-if="conference.url && conference.url_name"
                        :href="conference.url"
                      >{{ conference.url_name }}</a>
                    </div>
                  </div>
                </div>
              </nav>

              <b-tabs
                :value="tab"
                @input="setTab($event)"
                :animated="false"
                position="is-left"
                type="is-boxed"
              >
                <b-tab-item label="Overview">
                  <conference-overview
                    @update="fetchUser()"
                    v-if="conference"
                    :conference="conference"
                  ></conference-overview>
                </b-tab-item>
                <b-tab-item label="SVs">
                  <conference-svs v-if="canViewUsers()" :conference="conference"></conference-svs>
                  <p v-else>You need to be accepted to see other SVs!</p>
                </b-tab-item>
                <b-tab-item label="Tasks">
                  <conference-tasks v-if="canViewUsers()" :conference="conference"></conference-tasks>
                  <p v-else>You need to be accepted to see tasks!</p>
                </b-tab-item>
                <b-tab-item v-if="canUpdateAssignment()" label="Assignments">
                  <conference-assignments v-show="tab==3" :conference="conference"></conference-assignments>
                </b-tab-item>
                <b-tab-item v-if="canEdit()" label="Conference">
                  <conference-edit
                    v-show="tab==4"
                    @updated="fetchConference()"
                    :conference="conference"
                  ></conference-edit>
                </b-tab-item>
                <b-tab-item v-if="canNotify()" label="Notify">
                  <conference-notification v-show="tab==5" :conference="conference"></conference-notification>
                </b-tab-item>
                <b-tab-item v-if="canUpdateAssignment()" label="Reports">
                  <conference-reports v-show="tab==6" :conference="conference"></conference-reports>
                </b-tab-item>
              </b-tabs>
            </div>
          </div>
        </div>
      </transition>
      <!--  -->
    </div>
  </div>
</template>

<script>
import api from "@/api.js";
import { mapActions, mapMutations, mapGetters } from "vuex";

export default {
  data() {
    return {
      isLoading: true
    };
  },

  created() {
    let key = this.$route.params.key;
    this.prepareConference(key);
  },

  computed: {
    ...mapGetters("conference", ["conference", "tab"]),
    ...mapGetters("auth", ["userIs"])
  },
  methods: {
    prepareConference(key) {
      var promises = [];

      if (!this.conference || this.conference.key != key) {
        promises.push(
          this.fetchConference(key).catch(error => {
            this.$router.replace({ name: "conferences" });
          })
        );
      } else {
        // Show UI earlier - makes it feel faster
        this.isLoading = false;
      }

      promises.push(this.fetchAcceptedCount(key));
      promises.push(this.fetchTaskDays(key));
      if (this.canViewUsers(key)) {
        promises.push(this.fetchSvs(key));
      }
      if (this.canViewUsers(key)) {
        promises.push(this.fetchTasks(key));
      }
      if (this.canUpdateAssignment(key)) {
        promises.push(this.fetchAssignments(key));
      }

      Promise.all(promises)
        .then(() => {
          this.isLoading = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
    canViewUsers(key) {
      let k = key || this.conference.key;
      return (
        this.userIs("admin") ||
        this.userIs("chair", k) ||
        this.userIs("captain", k) ||
        this.userIs("sv", k, "accepted")
      );
    },
    canEdit(key) {
      let k = key || this.conference.key;
      return this.userIs("admin") || this.userIs("chair", k);
    },
    canUpdateEnrollment(key) {
      let k = key || this.conference.key;
      return this.userIs("admin") || this.userIs("chair", k);
    },
    canUpdateAssignment(key) {
      let k = key || this.conference.key;
      return (
        this.userIs("admin") ||
        this.userIs("chair", k) ||
        this.userIs("captain", k)
      );
    },
    canNotify(key) {
      let k = key || this.conference.key;
      return (
        this.userIs("admin") ||
        this.userIs("chair", k) ||
        this.userIs("captain", k)
      );
    },
    ...mapActions("auth", ["fetchUser"]),
    ...mapActions("svs", ["fetchSvs"]),
    ...mapActions("tasks", ["fetchTasks"]),
    ...mapActions("assignments", ["fetchAssignments"]),
    ...mapActions("conference", [
      "fetchConference",
      "fetchTaskDays",
      "fetchAcceptedCount"
    ]),
    ...mapMutations("conference", ["setTab"])
  }
};
</script>