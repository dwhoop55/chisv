<template>
  <b-carousel :indicator="false" :pause-info="false" :arrow="false" :interval="5000">
    <b-loading :is-full-page="false" :active="isLoading"></b-loading>
    <b-carousel-item v-for="(conference, index) in conferences" :key="index">
      <div class="is-100vh">
        <div
          class="card-image is-cover"
          :style="`height:350px;${conferenceArtworkBackground(conference)}`"
        >
          <div
            :style="stateBackground(conference.state)"
            class="has-text-centered has-text-weight-bold has-text-shadow is-rounded-b-l is-rounded-b-r is-pinned-t is-pinned-l has-text-white-bis is-absolute has-margin-l-7 has-padding-r-5 has-padding-l-5 has-padding-b-7 has-padding-t-7"
          >
            <p>{{ conference.name }}</p>
            <p>{{ (conference.state && conference.state.name) ? conference.state.name : "Unknown status" | capitalize }}</p>
          </div>
        </div>
      </div>
    </b-carousel-item>
  </b-carousel>
</template>

<script>
import api from "@/api";

export default {
  data() {
    return {
      isLoading: true,
      conferences: [
        {
          name: "Loading"
        }
      ]
    };
  },

  created() {
    api.getConferencesPreview().then(({ data }) => {
      this.conferences = data;
      this.isLoading = false;
    });
  }
};
</script>