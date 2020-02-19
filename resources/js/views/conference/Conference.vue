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
              :value="$store.getters.conferenceTab"
              :animated="false"
              position="is-left"
              type="is-boxed"
              @input="$store.commit('CONFERENCE_TAB', $event)"
            >
              <b-tab-item label="Overview">
                <conference-overview @update="getCan()" v-if="conference" v-model="conference"></conference-overview>
              </b-tab-item>
              <b-tab-item label="SVs">
                <conference-users v-if="canViewUsers" :conference="conference"></conference-users>
                <p v-else>You need to be accepted to see other SVs!</p>
              </b-tab-item>
              <b-tab-item label="Tasks">
                <conference-tasks v-if="canViewUsers" :conference="conference"></conference-tasks>
                <p v-else>You need to be accepted to see tasks!</p>
              </b-tab-item>
              <b-tab-item v-if="canUpdateAssignment" label="Assignments">
                <conference-assignments
                  v-if="$store.getters.conferenceTab==3"
                  :conference="conference"
                ></conference-assignments>
              </b-tab-item>
              <b-tab-item v-if="canEdit" label="Conference">
                <conference-edit v-if="$store.getters.conferenceTab==4" v-model="conference"></conference-edit>
              </b-tab-item>
              <b-tab-item v-if="canUpdateAssignment" label="Reports">
                <conference-reports v-if="$store.getters.conferenceTab==5" :conference="conference"></conference-reports>
              </b-tab-item>
            </b-tabs>
          </div>
        </div>
      </div>
      <!--  -->
    </div>
    <b-loading :is-full-page="false" :active="loading"></b-loading>
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";

export default {
  props: ["conferenceKey"],

  data() {
    return {
      loading: true,
      canEdit: false,
      canUpdateEnrollment: false,
      canUpdateAssignment: false,
      canViewUsers: false,
      conference: null
    };
  },

  created() {
    this.getConference();
  },

  methods: {
    getCan: async function() {
      this.canEdit = await auth.can("update", "Conference", this.conference.id);
      this.canUpdateEnrollment = await auth.can(
        "updateEnrollment",
        "Conference",
        this.conference.id
      );
      this.canViewUsers = await auth.can(
        "viewUsers",
        "Conference",
        this.conference.id
      );
      this.canUpdateAssignment = await auth.can(
        "viewAssignments",
        "Conference",
        this.conference.id
      );
    },
    getConference: function() {
      api
        .getConference(this.conferenceKey)
        .then(data => {
          this.conference = data.data;
          this.getCan();
          this.$store.commit("LAST_CONFERENCE", this.conference.key);
        })
        .catch(error => {
          this.$buefy.notification.open(error.message);
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>