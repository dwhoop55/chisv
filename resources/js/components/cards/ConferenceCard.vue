<template>
  <a :href="conferenceUrl">
    <div class="card is-hoverable-anim is-clickable is-100vh">
      <div class="card-image is-cover" :style="divImage">
        <div
          :style="stateBackground"
          class="has-text-weight-bold has-text-shadow is-rounded-b-l is-rounded-b-r is-pinned-t is-pinned-r has-text-white-bis is-absolute has-margin-r-7 has-padding-l-5 has-padding-r-5 has-padding-b-7 has-padding-t-7"
        >{{ conference.state.name }}</div>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48">
              <img :src="icon" />
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-4">{{ conference.name | textlimit(70) }}</p>
            <p
              class="subtitle is-6"
            >{{ conference.start_date | moment("ll") }} – {{ conference.end_date | moment("ll") }}</p>
          </div>
        </div>
        <div class="content">{{ conference.description | textlimit(300) }}</div>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: ["conference", "fallbackImage"],

  computed: {
    stateBackground: function() {
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
    divImage: function() {
      return `height: 200px; background-image:url(${this.image})`;
    },
    image: function() {
      if (this.conference.image && this.conference.image.path) {
        return this.conference.image.path;
      } else {
        return this.fallbackImage;
      }
    },
    icon: function() {
      if (this.conference.icon && this.conference.icon.path) {
        return this.conference.icon.path;
      } else {
        return `https://avatars.dicebear.com/v2/jdenticon/${this.conference.key}.svg`;
      }
    },
    conferenceUrl: function() {
      return `/conference/${this.conference.key}`;
    }
  }
};
</script>