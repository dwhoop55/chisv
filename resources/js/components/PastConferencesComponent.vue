<template>
  <div v-if="user">
    <div class="is-relative has-margin-b-6">
      <b-loading :active="isSuccess.past_conferences" :is-full-page="false">
        <b-icon size="is-large" type="is-success" icon="check-bold"></b-icon>
      </b-loading>
      <b-field expanded label="Past conferences you have attended">
        <b-taginput
          ref="past_conferences"
          @input="onChange($event, 'past_conferences')"
          placeholder="Use one tag per conference"
          icon="tag"
          :attached="true"
          :value="user.past_conferences"
        ></b-taginput>
      </b-field>
    </div>

    <div class="is-relative">
      <b-loading :active="isSuccess.past_conferences_sv" :is-full-page="false">
        <b-icon size="is-large" type="is-success" icon="check-bold"></b-icon>
      </b-loading>
      <b-field expanded label="Past conferences you have attended as SV">
        <b-taginput
          ref="past_conferences_sv"
          @input="onChange($event, 'past_conferences_sv')"
          placeholder="Use one tag per conference"
          icon="tag"
          :attached="true"
          :value="user.past_conferences_sv"
        ></b-taginput>
      </b-field>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      isLoading: {
        past_conferences: false,
        past_conferences_sv: false
      },
      isSuccess: {
        past_conferences_sv: false,
        past_conferences: false
      }
    };
  },

  computed: mapGetters("auth", ["user"]),

  methods: {
    onChange(array, type) {
      this.isLoading[type] = true;
      this.updatePastConferences({ array, type })
        .then(() => {
          this.isSuccess[type] = true;
          setTimeout(() => {
            this.isSuccess[type] = false;
          }, 800);
        })
        .catch(error => console.log(error))
        .finally(() => (this.isLoading[type] = false));
    },
    ...mapActions("auth", ["updatePastConferences"])
  }
};
</script>
