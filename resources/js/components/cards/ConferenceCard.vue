<template>
  <div class="card">
    <div class="card-image is-cover" :style="backgrounStyle">
      <!-- <figure class="image is-16by2 is-cover">
        <img :src="image" />
      </figure>-->
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

      <div class="content">
        {{ conference.description | textlimit(300) }}
        <br />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["conference", "fallbackImage"],

  computed: {
    backgrounStyle: function() {
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
    }
  }
};
</script>