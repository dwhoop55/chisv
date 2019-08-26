<template>
  <div>
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
              </b-taglist>
            </div>
          </div>
        </nav>

        <div class="card has-padding-5">
          <nav class="level">
            <div class="level-left">
              <div class="level-item is-block">
                <p class="has-text-weight-medium">{{ conference.location }}</p>
                <p
                  class="has-text-weight-medium"
                >{{ conference.start_date | moment("ll") }} – {{ conference.end_date | moment("ll") }}</p>
              </div>
            </div>
            <div class="level-right">
              <div class="level-item">
                <div class="buttons">
                  <transition name="slide-fade">
                    <b-button
                      v-if="canEdit"
                      @click="goTo(`/conference/${conference.key}/edit`)"
                      type="is-warning"
                    >Edit</b-button>
                  </transition>
                  <b-button
                    @click="goTo(`/conference/${conference.key}/task`)"
                    type="is-primary"
                  >Tasks</b-button>
                  <b-button
                    @click="goTo(`/conference/${conference.key}/user`)"
                    type="is-primary"
                  >People</b-button>
                  <b-button
                    v-if="conference.url && conference.url_name"
                    @click="goTo(conference.url)"
                    type="is-primary"
                  >{{ conference.url_name }}</b-button>
                </div>
              </div>
            </div>
          </nav>

          <enrollment-component :conference="conference"></enrollment-component>

          <p class="content has-margin-t-1">{{ conference.description | textlimit(1000) }}</p>
        </div>
      </div>
    </div>
    <!--  -->
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["conference"],

  data() {
    return {
      canEdit: false
    };
  },

  created() {
    this.checkCan();
  },

  methods: {
    checkCan: function() {
      api
        .can("update", "Conference", this.conference.id)
        .then(data => (this.canEdit = data.data.result));
    }
  }
};
</script>