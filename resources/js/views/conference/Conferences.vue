<template>
  <section>
    <b-field v-if="userIs('admin')" grouped position="is-right">
      <b-button @click="showCreate()" class="button">Add Conference</b-button>
    </b-field>
    <div class="columns is-multiline is-flex-stretch is-relative">
      <div
        class="column is-half"
        v-for="conference in conferences"
        :key="conference.id"
      >
        <conference-card :conference="conference"></conference-card>
      </div>
      <b-loading :is-full-page="false" :active="isLoading"></b-loading>
    </div>
  </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import CreateConferenceModalVue from "../../components/modals/CreateConferenceModal.vue";

export default {
  created() {
    this.fetchConferences();
  },

  computed: {
    ...mapGetters("conferences", ["conferences", "isLoading"]),
    ...mapGetters("auth", ["userIs"]),
  },

  methods: {
    showCreate() {
      this.$buefy.modal.open({
        parent: this,
        component: CreateConferenceModalVue,
      });
    },
    ...mapActions("conferences", ["fetchConferences"]),
  },
};
</script>
