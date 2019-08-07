<template>
  <section>
    <navbar></navbar>
    <router-view></router-view>
  </section>
</template>

<script>
import links from "@/config/menu.js";
import axios from "@/plugins/axios.js";

export default {
  data: () => ({
    drawer: null,
    links: links
  }),
  computed: {
    token() {
      let token = document.head.querySelector('meta[name="csrf-token"]');
      return token.content;
    }
  },
  methods: {
    logout() {
      document.getElementById("logout-form").submit();
    }
  }
};
</script>