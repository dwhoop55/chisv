<template>
  <b-field label="Destinations">
    <b-taginput
      :value="value"
      :data="filteredAvailableDestinations"
      @typing="search=$event"
      autocomplete
      field="display"
      icon="label"
      placeholder="Pick destinations from the list or manually add email adresses"
      allow-new
      attached
      :loading="isLoading"
      open-on-focus
      :before-adding="beforeAdd"
      @input="onChange($event)"
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
  props: ["conference", "value"],

  data() {
    return {
      search: "",
      isLoading: false,
      availableDestinations: []
    };
  },

  created() {
    this.getDestinations();
  },

  computed: {
    filteredAvailableDestinations() {
      if (this.search == "") {
        return this.availableDestinations;
      } else {
        return this.availableDestinations.filter(destination => {
          return (
            destination.display
              .toLowerCase()
              .indexOf(this.search.toLowerCase()) >= 0
          );
        });
      }
    }
  },

  methods: {
    onChange(tags) {
      var allTags = tags.map(tag => {
        if (this.isEmail(tag)) {
          return {
            type: "email",
            email: tag,
            display: tag
          };
        } else {
          return tag;
        }
      });

      this.$emit("input", allTags);
      this.search = "";
    },
    beforeAdd(tag) {
      if (tag.type == "user" || tag.type == "group") {
        // Tag is a tag from the backend
        return true;
      } else if (this.isEmail(tag)) {
        // Tag is a manually typed email
        return true;
      } else {
        // No valid input
        this.$buefy.toast.open({
          message: "Choose from the list or append an email",
          type: "is-danger"
        });
        return false;
      }
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
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>
