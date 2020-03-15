<template>
  <b-navbar type="is-primary">
    <template slot="brand">
      <b-navbar-item href="/">
        <p class="has-text-weight-bold">chisv</p>
      </b-navbar-item>
    </template>
    <template slot="start">
      <b-navbar-item tag="router-link" to="/conference">Conferences</b-navbar-item>
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
    ...mapGetters("conference", ["conference", "last"])
  },
  methods: {
    logout() {
      auth.logout();
    }
  }
};
</script>