<template>
  <section>
    <b-field v-if="userIs('admin')" grouped position="is-right">
      <b-button @click="showCreateModal=true" class="button">Add Conference</b-button>
    </b-field>
    <div class="columns is-multiline is-flex-stretch">
      <div class="column is-half" v-for="conference in conferences" :key="conference.id">
        <conference-card :conference="conference"></conference-card>
      </div>
    </div>

    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
    <b-modal :active.sync="showCreateModal" has-modal-card>
      <create-conference-modal @created="editConference"></create-conference-modal>
    </b-modal>
  </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  data() {
    return {
      showCreateModal: false
    };
  },

  created() {
    if (!this.conferences) {
      this.fetchConferences();
    }
  },

  computed: {
    ...mapGetters("conferences", ["conferences", "isLoading"]),
    ...mapGetters("auth", ["userIs"])
  },

  methods: {
    editConference(key) {
      this.$store.commit("CONFERENCE_TAB", 4);
      this.goTo(`/conference/${key}`);
    },
    ...mapActions("conferences", ["fetchConferences"])
  }
};
</script>
