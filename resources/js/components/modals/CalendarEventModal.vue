<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ event.title }}</p>
    </header>
    <section class="modal-card-body">
      <div class="content">
        <div class="subtitle has-margin-b-4" v-if="event.title.length > 50">{{ event.title }}</div>
        <div class="has-margin-b-4" v-if="event.description">{{ event.description }}</div>
        <b-switch v-model="eventTimezone">{{ activeTimezoneDisplay }}</b-switch>
        <ul>
          <li>
            Starts:
            {{ momentize(event.startString, {format: 'lll', fromTz: event.timezone, toTz: activeTimezone}) }}
          </li>
          <li>
            Ends:
            {{ momentize(event.endString, {format: 'lll', fromTz: event.timezone, toTz: activeTimezone}) }}
          </li>
          <li>Location: {{ event.location }}</li>
          <li v-if="state">
            Status:
            <state-tag :state="state"></state-tag>
          </li>
          <li
            v-if="event.assignment.hours"
          >Hours: {{ hoursFromTime(timeFromDecimal(event.assignment.hours)) }}</li>
        </ul>
      </div>
    </section>
    <footer class="modal-card-foot">
      <b-button type="is-primary" @click="$parent.close()">Close</b-button>
      <b-button type="is-primary" @click="exportEvent()">Export this event</b-button>
    </footer>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["event"],
  name: "CalendarEventModal",

  data() {
    return {
      eventTimezone: true
    };
  },

  computed: {
    state() {
      return this.event.assignment?.state || null;
    },
    activeTimezone() {
      return this.eventTimezone
        ? this.event.timezone
        : this.$moment.tz.guess(true);
    },
    activeTimezoneDisplay() {
      return this.eventTimezone
        ? `${this.activeTimezone} (conference timezone)`
        : `${this.activeTimezone} (your local timezone)`;
    }
  },

  methods: {
    exportEvent() {
      let event = this.createVEvent(
        this.event.title,
        this.event.timezone,
        this.event.start,
        this.event.end,
        this.event.location,
        this.event.description
      );
      this.downloadText(
        this.createVCalendar([event]),
        `${this.event.title}.ics`
      );
    }
  }
};
</script>