<template>
  <div>
    <div v-if="!notifications || notifications.length == 0">
      <p class="is-size-6 has-margin-5 has-text-dark">No notifications yet</p>
    </div>
    <div v-else>
      <b-table
        :default-sort="['created_at', 'asc']"
        class="is-clickable"
        @click="showNotification($event.id)"
        hoverable
        :data="notifications"
      >
        <template slot-scope="props">
          <b-table-column label="Conference" width="1">
            <p
              :class="{ 'has-text-weight-bold' : !props.row.read_at }"
            >{{ props.row.conference_key.toUpperCase() }}</p>
          </b-table-column>
          <b-table-column field="data.created_at" label="Posted" width="1">
            <b-tooltip :label="timeFormat(props.row.created_at, 'lll', {tz: true})">
              <p
                :class="{ 'has-text-weight-bold' : !props.row.read_at }"
              >{{ timeFormat(props.row.created_at, null, {fromNow: true, tz: true}) }}</p>
            </b-tooltip>
          </b-table-column>
          <b-table-column field="data.subject" label="Subject" width="1">
            <p :class="{ 'has-text-weight-bold' : !props.row.read_at }">{{ props.row.subject }}</p>
          </b-table-column>
        </template>
      </b-table>
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
        return this.allNotifications.slice(0, this.limit);
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

