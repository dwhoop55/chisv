<template>
  <section>
    <b-field v-if="canCreate" grouped position="is-right">
      <b-button @click="showCreateModal=true" class="button">Add Conference</b-button>
    </b-field>
    <div class="columns is-multiline is-flex-conferences">
      <div class="column is-half" v-for="conference in conferences" :key="conference.id">
        <conference-card :conference="conference" :fallback-image="fallbackImage"></conference-card>
      </div>
    </div>

    <b-loading :is-full-page="false" :active.sync="loading"></b-loading>
    <b-modal :active.sync="showCreateModal" has-modal-card>
      <create-conference-modal @created="goToConference"></create-conference-modal>
    </b-modal>
  </section>
</template>

<script>
import api from "@/api.js";

export default {
  data() {
    return {
      conferences: null,
      loading: true,
      fallbackImage: "/images/conference-default.jpg",
      showCreateModal: false,
      canCreate: false
    };
  },

  created() {
    this.load();
    this.checkCanCreate();
  },

  methods: {
    checkCanCreate: function() {
      api
        .can("create", "Conference")
        .then(data => {
          this.canCreate = data.data.result;
        })
        .catch(error => {
          throw error;
        });
    },
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
    },
    goToConference: function(key) {
      this.goTo(`/conference/${key}/edit`);
    }
  }
};
</script>
