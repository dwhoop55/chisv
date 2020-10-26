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
        <conference-card
          v-if="conference"
          :conference="conference"
          @click="enterConference(conference)"
        ></conference-card>
      </div>
      <b-loading
        :is-full-page="false"
        :active="!conferences && isLoading"
      ></b-loading>
    </div>
  </section>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
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
    enterConference(conference) {
      this.setConference(conference);
      this.$router.push({
        name: "conference",
        params: { key: conference.key },
      });
    },
    showCreate() {
      this.$buefy.modal.open({
        parent: this,
        component: CreateConferenceModalVue,
      });
    },
    ...mapActions("conferences", ["fetchConferences"]),
    ...mapActions("conference", ["fetchConference"]),
    ...mapMutations("conference", ["setConference"]),
  },
};
</script>
