<template>
  <b-field label="Destinations">
    <b-button @click="getDestinations">Reload</b-button>
    <b-taginput
      :value="destinations"
      :data="availableDestinations"
      autocomplete
      field="display"
      icon="label"
      placeholder="Add one ore multiple destinations"
      allow-new
      attached
      :loading="isLoading"
      open-on-focus
      @add="validateAdd($event)"
    >
      <template slot-scope="props">
        <strong>{{props.option.type}}</strong>
        {{props.option.display}}
      </template>
      <template slot="empty">There are no destinations with the given name</template>
    </b-taginput>
  </b-field>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["conference", "destinations"],
  model: {
    prop: "destinations"
  },

  data() {
    return {
      isLoading: false,
      availableDestinations: []
    };
  },

  created() {
    this.getDestinations();
  },

  methods: {
    validateAdd(event) {
      console.log(event);
    },
    getDestinations() {
      this.isLoading = true;
      api
        .getDestinations(this.conference.key)
        .then(({ data }) => {
          var available = this.availableDestinations;
          available = available.concat(data.groups);
          available = available.concat(data.users);
          this.availableDestinations = available;
        })
        .catch(error => {})
        .finally((this.isLoading = false));
    }
  }
};
</script>
