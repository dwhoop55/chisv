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
                'has-text-danger': props.option.stats.hours_done >= conference.volunteer_hours,
            }"
            >{{ props.option.firstname }} {{ props.option.lastname }}</strong>
            <small>{{ props.option.university }}</small>
            <div class="level">
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Hours done (+today)</p>
                  <div class="subtitle">
                    <small
                      :class="{
                'has-text-danger has-text-weight-bold': props.option.stats.hours_done >= conference.volunteer_hours,
            }"
                    >
                      <b-tooltip
                        multiline
                        label="Total hours all days (done)"
                      >{{ props.option.stats.hours_done }}</b-tooltip>
                      <b-tooltip
                        multiline
                        label="Hours the SV will do today (assigned/checked-in)"
                      >(+{{ props.option.stats.hours_assigned_today }})</b-tooltip>
                    </small>
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
                    >{{ preferenceToString(props.option.bid.preference) }}</small>
                    <small v-else>no bid</small>
                  </div>
                </div>
              </div>
              <div v-if="props.option.stats.bids_placed" class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids placed</p>
                  <div class="subtitle">
                    <b-tooltip type="is-danger" label="Unavailable">
                      <small
                        class="has-text-danger"
                      >{{ props.option.stats.bids_placed['unavailable'] }}</small>
                    </b-tooltip>
                    <b-tooltip type="is-info" label="Low">
                      <small class="has-text-info">{{ props.option.stats.bids_placed['low'] }}</small>
                    </b-tooltip>
                    <b-tooltip type="is-warning" label="Medium">
                      <small class="has-text-warning">{{ props.option.stats.bids_placed['medium'] }}</small>
                    </b-tooltip>
                    <b-tooltip type="is-success" label="High">
                      <small class="has-text-success">{{ props.option.stats.bids_placed['high'] }}</small>
                    </b-tooltip>
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
          | SVs already assigned or unavailable are not shown
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