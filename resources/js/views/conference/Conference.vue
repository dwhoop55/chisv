<template>
  <div>
    <b-loading :active="!conference"></b-loading>
    <div>
      <div
        class="is-fixed is-100hw is-100vh is-pinned-l is-pinned-t is-cover is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(conference)"
      ></div>

      <transition name="fade">
        <div v-if="conference" class="columns is-centered">
          <div
            class="column is-12-mobile is-12-tablet is-11-desktop is-paddingless"
          >
            <div class="level is-mobile">
              <div class="level-left">
                <div class="level-item">
                  <figure class="image is-48x48">
                    <img :src="conferenceIcon(conference)" />
                  </figure>
                </div>
                <div class="level-item">
                  <p class="is-size-3 has-text-black-bis has-text-weight-bold">
                    {{ conference.name | textlimit(50) }}
                  </p>
                  <b-taglist attached class="has-margin-l-6 is-hidden-desktop">
                    <b-tag
                      rounded
                      size="is-small"
                      v-if="conference.bidding_enabled"
                      type="is-success"
                      >Bidding open</b-tag
                    >
                    <b-tag rounded size="is-small" v-else type="is-warning"
                      >Bidding closed</b-tag
                    >
                  </b-taglist>
                </div>
                <div class="level-item is-hidden-touch">
                  <b-taglist attached>
                    <state-tag
                      size="is-medium"
                      :state="conference.state"
                    ></state-tag>

                    <b-tag
                      v-if="conference.bidding_enabled"
                      rounded
                      size="is-medium"
                      type="is-success"
                    >
                      <b-tooltip type="is-success" :label="biddingEnabledFor"
                        >Bidding open</b-tooltip
                      >
                    </b-tag>
                    <b-tag rounded size="is-medium" v-else type="is-warning"
                      >Bidding closed</b-tag
                    >
                  </b-taglist>
                </div>
              </div>
            </div>

            <div class="card">
              <nav class="level has-padding-6">
                <div class="level-left is-">
                  <div class="level-item is-block">
                    <p class="has-text-weight-medium">
                      {{ conference.location }}
                      |
                      {{
                        momentize(conference.start_date, {
                          format: "ll",
                          fromTz: conference.timezone.name,
                          toTz: conference.timezone.name,
                        })
                      }}
                      –
                      {{
                        momentize(conference.end_date, {
                          format: "ll",
                          fromTz: conference.timezone.name,
                          toTz: conference.timezone.name,
                        })
                      }}
                    </p>
                    <a
                      v-if="conference.email_chair"
                      class="has-text-weight-medium"
                      :href="'mailto:' + conference.email_chair"
                      >{{ conference.email_chair }}</a
                    >
                    <a
                      class="is-hidden-desktop"
                      target="_blank"
                      v-if="conference.url && conference.url_name"
                      :href="conference.url"
                      >&nbsp;{{ conference.url_name }}</a
                    >
                  </div>
                </div>
                <div class="level-right is-hidden-touch">
                  <div class="level-item">
                    <div class="buttons">
                      <a
                        class="button is-primary has-margin-l-6"
                        target="_blank"
                        v-if="conference.url && conference.url_name"
                        :href="conference.url"
                        >{{ conference.url_name }}</a
                      >
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
                  <conference-svs
                    v-if="canViewUsers()"
                    :conference="conference"
                  ></conference-svs>
                  <p v-else>You need to be accepted to see other SVs!</p>
                </b-tab-item>
                <b-tab-item label="Tasks">
                  <conference-tasks
                    v-if="canViewUsers()"
                    :conference="conference"
                  ></conference-tasks>
                  <p v-else>You need to be accepted to see tasks!</p>
                </b-tab-item>
                <b-tab-item v-if="canUpdateAssignment()" label="Assignments">
                  <conference-assignments
                    :conference="conference"
                  ></conference-assignments>
                </b-tab-item>
                <b-tab-item v-if="canEdit()" label="Conference">
                  <conference-edit
                    @updated="fetchConference()"
                    :conference="conference"
                  ></conference-edit>
                </b-tab-item>
                <b-tab-item v-if="canNotify()" label="Notify">
                  <conference-notification
                    ref="notify"
                    :conference="conference"
                  ></conference-notification>
                </b-tab-item>
                <b-tab-item v-if="canUpdateAssignment()" label="Reports">
                  <conference-reports
                    @update-notify-destinations="
                      $refs.notify.setDestinations($event)
                    "
                    :conference="conference"
                  ></conference-reports>
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
  name: "Conference",

  data() {
    return {
      // isLoading: true,
    };
  },

  created() {
    let key = this.$route.params.key;
    this.fetchUser();
    this.fetchConference(key).catch((error) => {
      this.$router.replace({ name: "conferences" });
    });
    window.scrollTo(0, 0);
    // this.prepareConference(key);
  },

  computed: {
    biddingEnabledFor() {
      return (
        this.momentize(this.conference.bidding_start, {
          format: "l",
          fromTz: this.conference.timezone.name,
          toTz: this.conference.timezone.name,
        }) +
        " – " +
        this.momentize(this.conference.bidding_end, {
          format: "l",
          fromTz: this.conference.timezone.name,
          toTz: this.conference.timezone.name,
        })
      );
    },
    ...mapGetters("conference", ["conference", "tab"]),
    ...mapGetters("auth", ["userIs"]),
  },
  methods: {
    prepareConference(key) {
      // First we need to fetch the user to have up to date permissions
      // These are very important because based on them the
      // task and sv view will not load. We need to wait for the
      // promise to resolve or we will have a reace condition
      // between up to date permissions in vuex and the sv/task list
      // being show or not
      this.fetchUser().then(() => {
        // Now we fetch all the view we need to show a complete
        // conference (svs/tasks/assignments if needed)
        // We add them to an promises array and wait for all to resolve
        // before we have all the components render
        // This makes the entire loading look better
        // and also catches all the cases where the data for
        // the view is not quite there yet

        var promises = [];

        // promises.push(
        //   this.fetchConference(key).catch((error) => {
        //     this.$router.replace({ name: "conferences" });
        //   })
        // );

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
          .finally(() => {
            this.isLoading = false;
          })
          .catch((error) => {
            console.log(error);
          });
      }); // fetchUser promise resolve
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
    // ...mapActions("svs", ["fetchSvs"]),
    // ...mapActions("tasks", ["fetchTasks"]),
    // ...mapActions("assignments", ["fetchAssignments"]),
    ...mapActions("conference", [
      "fetchConference",
      "fetchTaskDays",
      "fetchAcceptedCount",
    ]),
    ...mapMutations("conference", ["setTab"]),
  },
};
</script>