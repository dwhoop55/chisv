<template>
  <div>
    <b-loading :active="isLoading"></b-loading>
    <div>
      <div
        class="is-fixed is-100hw is-100vh is-pinned-l is-pinned-t is-cover is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(lastConference)"
      ></div>

      <transition name="fade">
        <div v-if="!isLoading" class="columns is-centered">
          <div class="column card is-11 has-padding-5">
            <div class="columns">
              <div class="column is-1">
                <b-field>
                  <b-datepicker
                    placeholder="Click to select..."
                    :value="days"
                    @input="onDaysChange"
                    :mobile-native="false"
                    :events="[...lastConferenceDays, ...lastConferenceTaskDays]"
                    inline
                    range
                    indicators="bars"
                  ></b-datepicker>
                </b-field>
                <b-field>
                  <b-button type="is-primary" @click="onExport">Export current selection</b-button>
                </b-field>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
export default {
  data() {
    return {
      isLoading: false
    };
  },

  created() {
    if (!this.interval || !this.interval.start) {
      // This is the initial state
      // We set it to the last conference's time
      // if there is one or if not just to the current day
      if (this.lastConference) {
        this.setInterval({
          start: this.lastConference.start_date,
          end: this.lastConference.end_date
        });
      } else {
        this.setInterval({
          start: new Date().toMySqlDate(),
          end: new Date().toMySqlDate()
        });
      }
    }

    if (!this.data) {
      this.isLoading = true;
    }
    this.fetchEvents().then(() => (this.isLoading = false));
  },

  methods: {
    onDaysChange(interval) {
      this.setInterval({
        start: interval[0].toMySqlDate(),
        end: interval[1].toMySqlDate()
      });
      this.isLoading = true;
      this.fetchEvents().then(() => (this.isLoading = false));
    },
    onExport() {},
    ...mapActions("calendar", ["fetchEvents"]),
    ...mapMutations("calendar", ["setInterval"])
  },

  computed: {
    days() {
      if (this.interval.start && this.interval.end) {
        return [
          this.dateFromMySql(this.interval.start),
          this.dateFromMySql(this.interval.end)
        ];
      } else {
        return [new Date(), new Date()];
      }
    },
    ...mapGetters("conference", {
      lastConference: "conference",
      lastConferenceDays: "conferenceDays",
      lastConferenceTaskDays: "taskDays"
    }),
    ...mapGetters("calendar", ["data", "interval"])
  }
};
</script>