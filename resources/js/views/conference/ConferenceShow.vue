<template>
  <div>
    <div v-if="conference">
      <div
        class="is-absolute is-100hw is-100vh is-cover is-pinned-t is-pinned-l is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(conference)"
      ></div>

      <div class="columns is-centered">
        <div class="column is-two-thirds">
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
                  >{{ conference.start_date | moment("ll") }} – {{ conference.end_date | moment("ll") }}</p>
                  <p class="has-text-weight-medium">{{ conference.location }}</p>
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

            <b-tabs v-model="activeTab" :animated="false" position="is-centered">
              <b-tab-item label="Overview">
                <conference-show-overview v-if="conference" v-model="conference"></conference-show-overview>
              </b-tab-item>
              <b-tab-item label="SVs">
                <conference-show-users :conference="conference"></conference-show-users>
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
    <b-loading :is-full-page="false" :active="!conference"></b-loading>
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";

export default {
  props: ["conferenceKey"],

  data() {
    return {
      canEdit: false,
      activeTab: 0,
      conference: null
    };
  },

  created() {
    this.getConference();
    if (window.location.hash == "#edit") {
      this.activeTab = 2;
    }
  },

  methods: {
    getCan: async function() {
      this.canEdit = await auth.can("update", "Conference", this.conference.id);
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
        });
    }
  }
};
</script>