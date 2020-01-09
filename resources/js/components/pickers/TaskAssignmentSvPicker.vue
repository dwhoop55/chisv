<template>
  <b-autocomplete
    :data="data"
    keep-first
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
                    :class="preferenceType(props.option.bid_preference).replace('is-', 'has-text-')"
                  >{{ props.option.bid_preference != undefined ? props.option.bid_preference : "no bid" }}</small>
                </div>
              </div>
            </div>
            <div class="level-item has-text-centered">
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
            <div class="level-item has-text-centered">
              <div>
                <p class="heading">Bids successful</p>
                <div class="subtitle">
                  <small class="has-text-danger">{{ props.option.stats.bids_successful[0] }}</small>
                  <small class="has-text-info">{{ props.option.stats.bids_successful[1] }}</small>
                  <small class="has-text-warning">{{ props.option.stats.bids_successful[2] }}</small>
                  <small class="has-text-success">{{ props.option.stats.bids_successful[3] }}</small>
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
        Bids below are displayed in
        <small class="has-text-danger">X</small>
        <small class="has-text-info">1</small>
        <small class="has-text-warning">2</small>
        <small class="has-text-success">3</small>
        preference order | SVs bound to this task are not shown
      </small>
      <b-loading :is-full-page="false" :active="isLoading"></b-loading>
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
    getPreferenceForCurrentTask(bids) {
      // Will find the bid for the current selected task
      var bid = bids.find(bid => bid.task_id == this.task.id);
      return bid ? parseInt(bid.preference) : null;
    },
    getAsyncData: debounce(function(name) {
      if (!name.length) {
        this.data = [];
        return;
      }
      this.isLoading = true;

      // Prepare an array with already assigned SVs
      // to later hide them in the list
      let existingSvs = this.task.assignments.map(assignment => {
        return assignment.user.id;
      });

      const params = [
        `search_string=${name}`,
        `selected_states=12` // SV state
      ].join("&");

      api
        .getConferenceSvs(this.conference.key, `?${params}`)
        .then(data => {
          // Only take SV which are not already assigned to the task
          this.data = data.data.data.filter(sv => !existingSvs.includes(sv.id));

          // Fetch the preference from all bids
          this.data = this.data.map(sv => {
            sv.bid_preference = this.getPreferenceForCurrentTask(sv.bids);
            return sv;
          });

          // Sort by preference descending
          this.data.sort((a, b) => {
            var x, y;
            if (a.bid_preference == undefined) {
              x = -1;
            } else {
              x = a.bid_preference;
            }

            if (b.bid_preference == undefined) {
              y = -1;
            } else {
              y = b.bid_preference;
            }

            return x > y ? -1 : 1;
          });
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
