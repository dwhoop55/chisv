<template>
  <b-navbar type="is-primary">
    <template slot="brand">
      <b-navbar-item href="/">
        <p class="has-text-weight-bold">chisv</p>
      </b-navbar-item>
    </template>
    <template slot="start">
      <b-navbar-item href="/conference">Conferences</b-navbar-item>
      <b-navbar-item v-if="userIs('admin') || userIs('chair')" href="/user">Users</b-navbar-item>
      <b-navbar-dropdown
        v-if="userIs('admin') || userIs('chair')"
        href="/job"
        hoverable
        label="System"
      >
        <b-navbar-item>Background Jobs</b-navbar-item>
        <hr class="navbar-divider" />
        <nav-build-info></nav-build-info>
      </b-navbar-dropdown>
      <b-navbar-item :href="`/conference/${conference.key}`">{{ conference.name }}</b-navbar-item>
    </template>

    <template slot="end">
      <b-navbar-dropdown right hoverable :label="firstname">
        <b-navbar-item v-if="id" :href="`/user/${id}/edit`">My Profile</b-navbar-item>
        <hr v-if="id" class="navbar-divider" />
        <b-navbar-item @click="logout()">Logout</b-navbar-item>
      </b-navbar-dropdown>
    </template>
  </b-navbar>
</template>

<script>
import auth from "@/auth";
import { mapGetters } from "vuex";

export default {
  computed: {
    id() {
      return this.user?.id || null;
    },
    firstname() {
      return this.user?.firstname || "Account";
    },
    ...mapGetters("auth", ["user", "userIs"]),
    ...mapGetters("conference", ["conference"])
  },
  methods: {
    logout() {
      auth.logout();
    }
  }
};
</script>