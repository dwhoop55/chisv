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
                    v-if="conference.enable_bidding==true"
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
              v-model="activeTab"
              :destroy-on-hide="true"
              :animated="false"
              position="is-centered"
              @input="goTo('#' + $event)"
            >
              <b-tab-item label="Overview">
                <conference-show-overview
                  @input="getConference()"
                  v-if="conference"
                  v-model="conference"
                ></conference-show-overview>
              </b-tab-item>
              <b-tab-item label="SVs">
                <conference-show-users v-if="canViewUsers" :conference="conference"></conference-show-users>
                <p v-else>You need to be enrolled to see other SVs!</p>
              </b-tab-item>
              <b-tab-item label="Tasks">
                <conference-show-tasks v-if="canViewUsers" :conference="conference"></conference-show-tasks>
                <p v-else>You need to be enrolled to see tasks!</p>
              </b-tab-item>
              <b-tab-item v-if="canEdit" label="Edit">
                <conference-edit v-model="conference"></conference-edit>
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
      canViewUsers: false,
      activeTab: 0,
      conference: null
    };
  },

  created() {
    this.getConference();

    // Using the hash for when the browser goes to
    // previous page, which should show the tab
    // we saw when we left the page. I know vue-router
    // would handle this but we don't have access to
    // that
    let hash = window.location.hash.substr(1);
    if (hash == "edit") {
      this.activeTab = 2;
    } else if (Number.isInteger(parseInt(hash))) {
      this.activeTab = parseInt(hash);
    }
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
    },
    getConference: function() {
      api
        .getConference(this.conferenceKey)
        .then(data => {
          this.conference = data.data;
          this.getCan();
        })
        .catch(error => {
          this.$buefy.notification(error.message);
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>