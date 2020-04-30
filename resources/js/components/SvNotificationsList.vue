<template>
  <div>
    <b-loading :is-full-page="false" :active="isLoading"></b-loading>
    <b-button
      v-if="!wasLoaded && ! isLoading"
      :disabled="isLoading"
      @click="getNotifications()"
      size="is-small"
    >{{ wasLoaded ? 'Reload' : 'Load' }}</b-button>
    <div v-if="hasNotifications">
      <b-table
        :default-sort="['created_at', 'desc']"
        :mobile-cards="false"
        narrowed
        sortable
        :data="notifications"
      >
        <b-input
          v-if="!props.column.numeric"
          slot="searchable"
          slot-scope="props"
          v-model="props.filters[props.column.field]"
          placeholder="Search..."
        />
        <template slot-scope="props">
          <b-table-column v-if="userIs('admin') || userIs('chair', conference.key)" width="50">
            <b-button @click="showNotification(props.row.id)" size="is-small">Open</b-button>
          </b-table-column>
          <b-table-column
            field="created_at"
            label="Date"
            width="180"
            sortable
          >{{ momentize(props.row.created_at, {format:'lll', fromTz: 'UTC', toTz: conference.timezone.name}) }}</b-table-column>
          <b-table-column field="data.subject" sortable label="Subject">{{ props.row.data.subject }}</b-table-column>
          <b-table-column field="read_at" width="180" label="Read" sortable>
            <p
              v-if="props.row.read_at"
            >{{ momentize(props.row.read_at, {format:'lll', fromTz: 'UTC', toTz: conference.timezone.name}) }}</p>
            <p v-else>Not yet</p>
          </b-table-column>
        </template>
      </b-table>
      <small
        class="has-text-weight-light"
      >Showing last 20 | Date and time are in conference time ({{ conference.timezone.name }})</small>
    </div>
    <div v-else-if="wasLoaded">
      <p>No Notifications yet</p>
    </div>
  </div>
</template>

<script>
import api from "@/api.js";
import NotificationsListModalVue from "./modals/NotificationsListModal.vue";
import { mapGetters } from "vuex";

export default {
  props: ["user", "conference"],

  data() {
    return {
      notifications: null,
      total: null,
      isLoading: false,
      wasLoaded: false
    };
  },

  mounted() {
    this.getNotifications();
  },

  computed: {
    hasNotifications() {
      console.log(this.notifications, this.notifications.length);
      return this.notifications && this.notifications.length > 0;
    },
    ...mapGetters("auth", ["userIs"])
  },

  methods: {
    showNotification(id) {
      this.$buefy.modal.open({
        parent: this,
        props: {
          showId: id
        },
        component: NotificationsListModalVue,
        hasModalCard: true
      });
    },
    getNotifications() {
      this.isLoading = true;
      api
        .getUserNotificationsForConference(this.user.id, this.conference.key)
        .then(({ data }) => {
          this.notifications = data.notifications;
          this.total = data.total;
          this.wasLoaded = true;
        })
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>