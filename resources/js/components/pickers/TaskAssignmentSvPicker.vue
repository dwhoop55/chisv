<template>
  <b-autocomplete
    :data="data"
    placeholder="Add SV.."
    :loading="isLoading"
    @typing="getAsyncData"
    @select="option => $emit('input', option)"
  >
    >
    <template slot-scope="props">
      <div class="media">
        <div class="media-left">
          <img width="64" :src="userAvatar(props.option)" />
        </div>
        <div class="media-content">
          <strong
            :class="{
                'has-text-danger': props.option.stats.hours_done >= conference.volunteer_max,
            }"
          >
            {{ props.option.firstname }} {{ props.option.lastname }}
            {{ props.option.stats.hours_done }}/{{ conference.volunteer_max }}
          </strong>
          <small>{{ props.option.university }}</small>
          <br />
          <small>Bids below are displayed in [ X, 1, 2, 3 ] preference order</small>
          <p>Bids placed: {{ props.option.stats.bids_placed }}</p>
          <p>Bids successful: {{ props.option.stats.bids_successful }}</p>
          <p>Bids unsuccessful: {{ props.option.stats.bids_unsuccessful }}</p>
        </div>
      </div>
    </template>
  </b-autocomplete>
</template>

<script>
import debounce from "lodash/debounce";
import api from "@/api.js";

export default {
  props: ["task", "conference"],

  data() {
    return {
      data: [],
      selected: null,
      isLoading: false
    };
  },
  methods: {
    getAsyncData: debounce(function(name) {
      if (!name.length) {
        this.data = [];
        return;
      }
      this.isLoading = true;

      const params = [`search_string=${name}`].join("&");

      api
        .getConferenceSvs(this.conference.key, `?${params}`)
        .then(data => {
          this.data = data.data.data;
        })
        .catch(error => {
          console.error(error);
        })
        .finally(() => {
          this.isLoading = false;
        });
    }, 500)
  }
};
</script>