<template>
  <b-navbar type="is-primary">
    <template slot="brand">
      <b-navbar-item tag="div" class="has-text-weight-bold">chisv</b-navbar-item>
    </template>

    <template slot="start">
      <b-navbar-item
        v-for="link in links"
        v-if="userHasRole(link.roles)"
        :key="link.name"
        :to="link.path"
        tag="router-link"
      >{{ link.name }}</b-navbar-item>
    </template>

    <template slot="end">
      <b-navbar-item tag="div">
        <div class="buttons">
          <a @click="logout" class="button is-light">Logout</a>
          <form id="logout-form" action="/logout" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="token" />
          </form>
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
</template>

<script>
import links from "@/config/menu.js";
import axios from "@/plugins/axios.js";
import user from "@/api/user.js";

export default {
  data() {
    return {
      links: links
    };
  },

  computed: {
    token() {
      let token = document.head.querySelector('meta[name="csrf-token"]');
      return token.content;
    }
  },

  methods: {
    logout() {
      document.getElementById("logout-form").submit();
    },
    userHasRole(role) {
      return user.userHasRole(role);
    }
  }
};
</script>