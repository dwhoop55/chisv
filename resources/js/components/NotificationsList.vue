<template>
  <div>
    <div v-if="!notifications || notifications.length == 0">
      <p class="subtitle has-margin-5 has-text-dark">No notifications yet</p>
    </div>
    <div v-else>
      <b-table @click="showNotification($event.id)" hoverable :data="notifications">
        <template slot-scope="props">
          <b-table-column label="Conference" width="1">
            <p
              :class="{ 'has-text-weight-bold' : !props.row.read_at }"
            >{{ props.row.conference_key.toUpperCase() }}</p>
          </b-table-column>
          <b-table-column field="data.created_at" label="Posted" width="1">
            <p
              :class="{ 'has-text-weight-bold' : !props.row.read_at }"
            >{{ tzFormat(props.row.created_at, null, {fromNow: true}) }}</p>
          </b-table-column>
          <b-table-column field="data.subject" label="Subject" width="1">
            <p :class="{ 'has-text-weight-bold' : !props.row.read_at }">{{ props.row.subject }}</p>
          </b-table-column>
        </template>
      </b-table>
      <div class="has-text-dark" v-if="notifications < allNotifications">
        <b-field grouped position="is-centered">
          <b-icon
            class="is-clickable has-margin-t-5"
            @click.native="$emit('show')"
            icon="dots-horizontal"
          ></b-icon>
        </b-field>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["limit"],

  computed: {
    notifications() {
      if (this.limit) {
        return this.allNotifications
          .reverse()
          .slice(0, this.limit)
          .reverse();
      } else return this.allNotifications;
    },
    ...mapGetters("notifications", {
      allNotifications: "notifications",
      unreadNotifications: "unread",
      lastFetch: "lastFetch"
    })
  },

  methods: {
    showNotification(id) {
      this.$emit("show", id);
    }
  },

  created() {
    if (this.isModal) {
      const unregisterRouterGuard = this.$router.beforeEach(
        (to, from, next) => {
          this.$parent.close();
          next(false);
        }
      );

      this.$once("hook:destroyed", () => {
        unregisterRouterGuard();
      });
    }
  }
};
</script>

