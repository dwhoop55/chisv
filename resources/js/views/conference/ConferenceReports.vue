<template>
  <div>
    <b-field grouped group-multiline>
      <b-select v-model="selected" @input="load($event)" placeholder="Select a report" required>
        <option value="shirt">T-Shirt</option>
        <option value="sv_hours">SV hours</option>
      </b-select>

      <b-field expanded></b-field>

      <b-field position="is-right">
        <b-button
          :disabled="!selected"
          @click="load(selected)"
          type="is-primary"
          icon-left="refresh"
        >Reload</b-button>
      </b-field>
    </b-field>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["conference"],

  data() {
    return {
      data: null,
      columns: null,
      isLoading: false,
      selected: null
    };
  },

  methods: {
    load(name) {
      this.isLoading = true;
      api
        .getReport(this.conference.key, name)
        .then(data => {
          this.data = data.data.data;
          this.columns = data.data.columns;
        })
        .catch(error => {
          var message = error.response.data.message
            ? error.response.data.message
            : error.message;
          this.$buefy.notification.open({
            duration: 5000,
            message: message,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>