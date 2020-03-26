<template>
  <div @click="enterConference()" class="card is-hoverable-anim is-clickable is-100vh">
    <div
      class="card-image is-cover"
      :style="`height:350px;${conferenceArtworkBackground(conference)}`"
    >
      <div
        :style="stateBackground(conference.state)"
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
          <p class="subtitle is-6">
            {{ formatTime(conference.start_date, "ll", {fromTz: conference.timezone.name, toTz: conference.timezone.name}) }}
            –
            {{ formatTime(conference.end_date, "ll", {fromTz: conference.timezone.name, toTz: conference.timezone.name}) }}
          </p>
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
    }
  }
};
</script>