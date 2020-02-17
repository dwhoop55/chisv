<template>
  <div class="is-larger-autocomplete">
    <b-autocomplete
      @focus="getAsyncData()"
      :data="data"
      keep-first
      :open-on-focus="true"
      placeholder="Add SV.."
      :loading="isLoading"
      :value="searchString"
      @typing="getAsyncData($event)"
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
            >{{ props.option.firstname }} {{ props.option.lastname }}</strong>
            <small>{{ props.option.university }}</small>
            <div class="level">
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Hours done</p>
                  <div class="subtitle">
                    <small
                      :class="{
                'has-text-danger has-text-weight-bold': props.option.stats.hours_done >= conference.volunteer_max,
            }"
                    >{{ props.option.stats.hours_done }}/{{ conference.volunteer_max }}</small>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bid</p>
                  <div class="subtitle">
                    <small
                      v-if="props.option.bid"
                      :class="preferenceType(props.option.bid.preference).replace('is-', 'has-text-')"
                    >{{ preferenceToString(props.option.bid.preference) }} {{ props.option.bid.user_created ? "" : "*" }}</small>
                    <small class="has-text-info" v-else>{{ preferenceToString(1) }} *</small>
                  </div>
                </div>
              </div>
              <div v-if="props.option.stats.bids_placed" class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids placed</p>
                  <div class="subtitle">
                    <small class="has-text-danger">{{ props.option.stats.bids_placed[0] }}</small>
                    <small class="has-text-info">{{ props.option.stats.bids_placed[1] }}</small>
                    <small class="has-text-warning">{{ props.option.stats.bids_placed[2] }}</small>
                    <small class="has-text-success">{{ props.option.stats.bids_placed[3] }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
      <template slot="empty">
        No SVs found. Make sure the SV you are looking for is
        <em>accepted</em>
      </template>
      <template slot="header">
        <small>
          Showing first {{ data.length }}/{{ total_matches }} SV{{ (data.length == 1) ? '' : "s" }}
          | Bids below are displayed in
          <small
            class="has-text-danger"
          >X</small>
          <small class="has-text-info">1</small>
          <small class="has-text-warning">2</small>
          <small class="has-text-success">3</small>
          preference order
          <br />SVs already assigned or unavailable are not shown | * = SV did not create bid
        </small>
        <b-loading :is-full-page="false" :active="isLoading"></b-loading>
      </template>
    </b-autocomplete>
  </div>
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
      isLoading: false,
      total_matches: 0,
      searchString: ""
    };
  },
  methods: {
    getAsyncData: debounce(function(search) {
      this.isLoading = true;
      this.searchString = search || search == "" ? search : "";
      const params = [`search_string=${this.searchString}`].join("&");

      api
        .getConferenceSvsForTaskAssignment(
          this.conference.key,
          this.task.id,
          `?${params}`
        )
        .then(data => {
          this.data = data.data.svs;
          this.total_matches = data.data.total_matches;
        })
        .catch(error => {
          console.error(error);
        })
        .finally(() => {
          this.isLoading = false;
        });
    }, 100)
  }
};
</script>

<style>
div.is-larger-autocomplete div.dropdown-menu > div.dropdown-content {
  max-height: 400px !important;
}
</style>