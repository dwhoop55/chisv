<template>
  <section>
    <b-field v-if="canCreate" grouped position="is-right">
      <b-button @click="showCreateModal=true" class="button">Add Conference</b-button>
    </b-field>
    <div class="columns is-multiline is-flex-stretch">
      <div class="column is-half" v-for="conference in conferences" :key="conference.id">
        <conference-card :conference="conference"></conference-card>
      </div>
    </div>

    <b-loading :is-full-page="false" :active.sync="loading"></b-loading>
    <b-modal :active.sync="showCreateModal" has-modal-card>
      <create-conference-modal @created="editConference"></create-conference-modal>
    </b-modal>
  </section>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";

export default {
  data() {
    return {
      conferences: null,
      loading: true,
      showCreateModal: false,
      canCreate: false
    };
  },

  created() {
    this.load();
    this.getCan();
  },

  methods: {
    getCan: async function() {
      this.canCreate = await auth.can("create", "Conference");
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
    editConference: function(key) {
      this.$store.commit("CONFERENCE_TAB", 4);
      this.goTo(`/conference/${key}`);
    }
  }
};
</script>
