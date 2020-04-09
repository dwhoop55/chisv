<template>
  <b-navbar fixed-top type="is-primary">
    <template slot="brand">
      <b-navbar-item tag="router-link" :to="{name: 'conferences'}">
        <p class="has-text-weight-bold">chisv</p>
      </b-navbar-item>
      <b-navbar-item class="is-hidden-desktop">
        <b-icon
          @click.native="showNotifications"
          class="has-margin-l-7 has-margin-r-7"
          v-if="hasUnread"
          type="is-warning"
          icon="bell-ring"
        />
      </b-navbar-item>
    </template>
    <template slot="start">
      <b-navbar-item tag="router-link" to="/conference">Conferences</b-navbar-item>
      <b-navbar-item tag="router-link" to="/calendar">Calendar</b-navbar-item>
      <b-navbar-item tag="router-link" to="/faq">FAQ</b-navbar-item>
      <b-navbar-item v-if="userIs('admin') || userIs('chair')" tag="router-link" to="/user">Users</b-navbar-item>
      <b-navbar-dropdown v-if="userIs('admin') || userIs('chair')" hoverable label="System">
        <b-navbar-item tag="router-link" to="/job">Background Jobs</b-navbar-item>
        <hr class="navbar-divider" />
        <nav-build-info></nav-build-info>
      </b-navbar-dropdown>
      <b-navbar-item
        v-if="last"
        tag="router-link"
        :to="{name: 'conference', params: { key: last.key}}"
      >{{ last.name }}</b-navbar-item>
    </template>

    <template slot="end">
      <!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
      <!-- Notifications for mobile -->
      <b-navbar-item @click="showNotifications" class="is-hidden-desktop">
        <span
          v-if="hasUnread"
          class="has-text-warning"
        >{{ numberUnread | pluralize('New notification') }}</span>
        <span v-else>Notifications</span>
      </b-navbar-item>
      <!-- Notifications for desktop -->
      <!-- We need to use the notificationDropdownActive 'hack' to trigger
      an update on the notification-list below. Without the times in the
      component are not updated and those times are relative-->
      <b-navbar-dropdown
        :active.sync="notificationDropdownActive"
        @mouseenter.native="notificationDropdownActive = true; fetchNotifications()"
        @mouseleave.native="notificationDropdownActive = false"
        ref="notificationDropdown"
        class="is-hidden-touch"
        right
        arrowless
        hoverable
      >
        <template slot="label">
          <b-icon
            @click.native="showNotifications"
            class="has-margin-l-6 has-margin-r-6"
            v-if="hasUnread"
            type="is-warning"
            icon="bell-ring"
          />
          <b-icon
            @click.native="showNotifications"
            class="has-margin-l-6 has-margin-r-6"
            v-else
            icon="bell"
          />
        </template>
        <notifications-list
          v-if="notificationDropdownActive"
          @show="showNotification($event)"
          :limit="limit"
          :style="notifications && notifications.length>0 ? 'width: 500px' : 'width: 220px'"
        ></notifications-list>
        <div class="has-text-dark" v-if="notifications.length > limit">
          <b-field class="is-clickable has-padding-t-6" @click.native="showNotifications()" grouped>
            <b-button type="is-text" expanded>{{ notifications.length - limit }} more</b-button>
          </b-field>
        </div>
      </b-navbar-dropdown>
      <!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

      <!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
      <!-- Profile and logout for mobile -->
      <b-navbar-item
        class="is-hidden-desktop"
        v-if="id"
        tag="router-link"
        :to="{name: 'user', params: { id}}"
      >My Profile</b-navbar-item>
      <b-navbar-item class="is-hidden-desktop" @click="showPrivacyPolicy()">Privacy Policy</b-navbar-item>
      <b-navbar-item class="is-hidden-desktop" @click="logout()">Logout</b-navbar-item>
      <!-- Profile and logout for desktop -->
      <b-navbar-dropdown class="is-hidden-touch" right hoverable :label="firstname">
        <b-navbar-item v-if="id" tag="router-link" :to="{name: 'user', params: { id}}">My Profile</b-navbar-item>
        <b-navbar-item @click.native="showPrivacyPolicy()">Privacy Policy</b-navbar-item>
        <hr v-if="id" class="navbar-divider" />
        <b-navbar-item @click="logout()">Logout</b-navbar-item>
      </b-navbar-dropdown>
      <!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
    </template>
  </b-navbar>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import NotificationsListModalVue from "./modals/NotificationsListModal.vue";
import PrivacyPolicyModalVue from "./modals/PrivacyPolicyModal.vue";

export default {
  data() {
    return {
      limit: 4,
      notificationDropdownActive: false
    };
  },

  computed: {
    id() {
      return this.user?.id || null;
    },
    firstname() {
      return this.user?.firstname || "Account";
    },
    ...mapGetters("auth", ["user", "userIs"]),
    ...mapGetters("conference", ["conference", "last"]),
    ...mapGetters("notifications", {
      hasUnread: "hasUnread",
      numberUnread: "numberUnread",
      notifications: "notifications"
    })
  },

  methods: {
    showPrivacyPolicy() {
      this.$buefy.modal.open({
        parent: this,
        component: PrivacyPolicyModalVue,
        hasModalCard: true,
        fullScreen: true
      });
    },
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
    showNotifications() {
      this.$buefy.modal.open({
        parent: this,
        component: NotificationsListModalVue,
        hasModalCard: true
      });
    },
    ...mapActions("auth", { logout: "logout" }),
    ...mapActions("notifications", ["fetchNotifications"])
  }
};
</script>