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
            <div class="level-item has-text-centered">
              <div>
                <p class="heading">Bids unsuccessful</p>
                <div class="subtitle">
                  <small class="has-text-danger">{{ props.option.stats.bids_unsuccessful[0] }}</small>
                  <small class="has-text-info">{{ props.option.stats.bids_unsuccessful[1] }}</small>
                  <small class="has-text-warning">{{ props.option.stats.bids_unsuccessful[2] }}</small>
                  <small class="has-text-success">{{ props.option.stats.bids_unsuccessful[3] }}</small>
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

      // Prepare an array with already assigned SVs
      // to later hide them in the list
      let existingSvs = this.task.assignments.map(assignment => {
        return assignment.user.id;
      });

      console.log(existingSvs);

      const params = [
        `search_string=${name}`,
        `selected_states=12` // SV state
      ].join("&");

      api
        .getConferenceSvs(this.conference.key, `?${params}`)
        .then(data => {
          this.data = data.data.data.filter(sv => !existingSvs.includes(sv.id));
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
