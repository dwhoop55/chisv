<template>
  <div @click="enterConference()" class="card is-hoverable-anim is-clickable is-100vh">
    <b-loading :is-full-page="false" :active="isLoading" />
    <div
      class="card-image is-cover"
      :style="`height:350px;${conferenceArtworkBackground(conference)}`"
    >
      <div
        :style="stateBackground"
        class="has-text-weight-bold has-text-shadow is-rounded-b-l is-rounded-b-r is-pinned-t is-pinned-r has-text-white-bis is-absolute has-margin-r-7 has-padding-l-5 has-padding-r-5 has-padding-b-7 has-padding-t-7"
      >{{ (conference.state && conference.state.name) ? conference.state.name : "Unknown status" }}</div>
    </div>
    <div class="card-content">
      <div class="media">
        <div class="media-left">
          <figure class="image is-48x48">
            <img :src="conferenceIcon(conference)" />
          </figure>
        </div>
        <div class="media-content">
          <p class="title is-4">{{ conference.name | textlimit(70) }}</p>
          <p
            class="subtitle is-6"
          >{{ conference.start_date | moment("ll") }} – {{ conference.end_date | moment("ll") }}</p>
        </div>
      </div>

      <div class="content">
        <VueShowdown :markdown="conferenceDescription" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  props: ["conference"],

  data() {
    return {};
  },

  methods: {
    enterConference() {
      if (this.isLoading) return;
      this.fetchConference(this.conference.key);
      this.$router.push({
        name: "conference",
        params: { key: this.conference.key }
      });
    },
    ...mapActions("conference", { fetchConference: "fetchConference" })
  },

  computed: {
    conferenceDescription() {
      if (!this.conference.description) {
        return "No description yet";
      }
      let length = 300;
      let str = this.conference.description.replace(/[#_\[\]]/g, "");
      let strSub = str.substr(0, length);
      if (str != strSub) {
        return strSub + "..";
      } else {
        return strSub;
      }
    },
    stateBackground: function() {
      if (!this.conference.state || !this.conference.state.name) {
        return "background: grey;";
      }
      let start = "#3cac8a";
      let end = "#5cceac";
      switch (this.conference.state.name) {
        case "over":
          start = "#BF360C";
          end = "#D84315";
          break;
        case "planning":
          start = "#FFB300";
          end = "#FFA000";
          break;
        case "enrollment":
          start = "#4ccc9a";
          end = "#6ceebc";
          break;
      }
      return `background: linear-gradient(.31deg,${start} .7%,${end} 99.3%);`;
    },
    ...mapGetters("conference", ["isLoading"])
  }
};
</script>