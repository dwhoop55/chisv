<template>
  <div>
    <div class="columns is-centered">
      <div class="column is-two-thirds">test</div>
    </div>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["conferenceKey"],

  data() {
    return {
      users: null
    };
  },

  created() {
    this.getUsers();
  },

  methods: {
    getUsers: async function() {
      this.users = await api.getConferenceUsers(this.conferenceKey);
    }
  }
};
</script>