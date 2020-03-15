<template>
  <div>
    <div v-if="conference">
      <div
        class="is-fixed is-100hw is-100vh is-pinned-l is-pinned-t is-cover is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(conference)"
      ></div>

      <div class="columns is-centered">
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
                  <b-tag rounded size="is-medium" v-else type="is-warning">Bidding currently closed</b-tag>
                </b-taglist>
              </div>
            </div>
          </nav>

          <div class="card has-padding-5">
            <nav class="level">
              <div class="level-left">
                <div class="level-item is-block">
                  <p
                    class="has-text-weight-medium"
                  >{{ conference.location }} | {{ conference.start_date | moment("ll") }} – {{ conference.end_date | moment("ll") }}</p>
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
                <conference-svs v-if="canViewUsers" :conference="conference"></conference-svs>
                <p v-else>You need to be accepted to see other SVs!</p>
              </b-tab-item>
              <b-tab-item label="Tasks">
                <conference-tasks v-if="canViewUsers" :conference="conference"></conference-tasks>
                <p v-else>You need to be accepted to see tasks!</p>
              </b-tab-item>
              <b-tab-item v-if="canUpdateAssignment" label="Assignments">
                <conference-assignments v-show="tab==3" :conference="conference"></conference-assignments>
              </b-tab-item>
              <b-tab-item v-if="canEdit" label="Conference">
                <conference-edit
                  v-show="tab==4"
                  @updated="fetchConference()"
                  :conference="conference"
                ></conference-edit>
              </b-tab-item>
              <b-tab-item v-if="canNotify" label="Notify">
                <conference-notification v-show="tab==5" :conference="conference"></conference-notification>
              </b-tab-item>
              <b-tab-item v-if="canUpdateAssignment" label="Reports">
                <conference-reports v-show="tab==6" :conference="conference"></conference-reports>
              </b-tab-item>
            </b-tabs>
          </div>
        </div>
      </div>
      <!--  -->
    </div>
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";
import { mapActions, mapMutations, mapGetters } from "vuex";

export default {
  props: ["conferenceKey"],

  data() {
    return {};
  },

  created() {
    let key = this.conferenceKey;
    this.fetchTaskDays(key);

    if (!this.conference || this.conference.key !== key) {
      this.fetchConference(key);
    }
  },

  computed: {
    canViewUsers() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key) ||
        this.userIs("sv", this.conference.key, "accepted")
      );
    },
    canEdit() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    canUpdateEnrollment() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    canUpdateAssignment() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key)
      );
    },
    canNotify() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key)
      );
    },
    ...mapGetters("conference", ["conference", "tab"]),
    ...mapGetters("auth", ["userIs"])
  },
  methods: {
    ...mapActions("auth", ["fetchUser"]),
    ...mapActions("conference", ["fetchConference", "fetchTaskDays"]),
    ...mapMutations("conference", ["setTab"])
  }
};
</script>