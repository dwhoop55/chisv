<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <div v-if="showDetail">
        <b-field grouped>
          <b-icon
            class="is-clickable has-margin-r-6"
            icon="arrow-left"
            @click.native="clearNotification()"
          ></b-icon>
          <p class="modal-card-title">{{ loadedNotification.data.subject }}</p>
        </b-field>
      </div>
      <p v-else class="modal-card-title">{{ numberUnread | pluralize('Unread notification') }}</p>
    </header>
    <section class="modal-card-body">
      <b-loading :is-full-page="false" :active="isLoading" />
      <transition name="fade">
        <div v-if="showDetail">
          <notification-display
            v-if="loadedNotification"
            :greeting="loadedNotification.data.greeting"
            :elements="loadedNotification.data.elements"
            :salutation="loadedNotification.data.salutation"
            :hide-greeting="true"
            :hide-salutation="true"
          ></notification-display>
        </div>
        <div v-else>
          <notifications-list @show="showNotification($event)" />
        </div>
      </transition>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Close</b-button>
    </section>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import api from "@/api";

export default {
  props: ["showId"],

  data() {
    return {
      loadedNotification: null,
      showDetail: false,
      isLoading: false
    };
  },

  created() {
    const unregisterRouterGuard = this.$router.beforeEach((to, from, next) => {
      if (this.showDetail && !this.showId) {
        this.clearNotification();
      } else {
        this.$parent.close();
      }
      next(false);
    });

    this.$once("hook:destroyed", () => {
      unregisterRouterGuard();
    });

    if (this.showId) {
      this.showNotification(this.showId);
    }
  },

  methods: {
    showNotification(id) {
      this.markRead(id);
      this.isLoading = true;
      api
        .getNotification(id)
        .then(({ data }) => {
          this.loadedNotification = data;
          this.showDetail = true;
        })
        .finally(() => (this.isLoading = false));
    },
    clearNotification() {
      this.loadedNotification = null;
      this.showDetail = false;
    },
    ...mapMutations("notifications", ["markRead"])
  },

  computed: mapGetters("notifications", ["notifications", "numberUnread"])
};
</script>

