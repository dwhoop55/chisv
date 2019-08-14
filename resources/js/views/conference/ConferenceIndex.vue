<template>
  <section class="section">
    <div class="columns is-multiline">
      <div class="column is-half" v-for="conference in conferences" :key="conference.id">
        <conference-card :conference="conference" :fallback-image="fallbackImage"></conference-card>
      </div>
    </div>

    <b-loading :is-full-page="false" :active.sync="loading"></b-loading>
  </section>
</template>

<script>
import api from "@/api.js";

export default {
  data() {
    return {
      conferences: null,
      loading: true,
      fallbackImage: "/images/conference-default.jpg"
    };
  },

  created() {
    this.load();
  },

  methods: {
    load: function() {
      api
        .getConferences()
        .then(data => {
          this.conferences = data.data.data;
        })
        .catch(error => {
          throw error;
        })
        .finally(() => {
          this.loading = false;
        });
    }
  }
};
</script>
