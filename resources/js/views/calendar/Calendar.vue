<template>
  <div>
    <div>
      <div
        class="is-fixed is-100hw is-100vh is-pinned-l is-pinned-t is-cover is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(lastConference)"
      ></div>

      <transition name="fade">
        <div class="is-relative">
          <div v-if="eventsForCalendar" class="columns is-centered">
            <div class="column card is-11 has-padding-5">
              <b-loading :is-full-page="false" :active="isLoading"></b-loading>
              <b-field class="is-absolute is-pinned-r has-margin-r-5" grouped position="is-right">
                <b-button icon-left="reload" @click="fetch()"></b-button>
              </b-field>
              <b-field>
                <vue-cal
                  today-button
                  :events="eventsForCalendar"
                  :disable-views="['years', 'year']"
                  :selected-date="dateFromMySql(startDate)"
                  :on-event-click="onEventClick"
                  events-on-month-view="short"
                  style="min-height: 600px"
                  show-all-day-events="short"
                  @ready="getEvents"
                  @view-change="getEvents"
                  :default-view="calView"
                ></vue-cal>
              </b-field>
              <b-field grouped position="is-right">
                <b-button disabled type="is-primary" @click="onExport">Export this view</b-button>
              </b-field>
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
    if (!this.startDate) {
      this.setStartDate(
        this.lastConference?.start_date || new Date().toMySqlDate()
      );
      this.setEndDate(
        this.lastConference?.end_date || new Date().toMySqlDate()
      );
    }

    if (!this.data) {
      this.isLoading = true;
    }
    this.fetchEvents().finally(() => (this.isLoading = false));
  },

  methods: {
    fetch() {
      this.isLoading = true;
      this.fetchEvents().finally(() => (this.isLoading = false));
    },
    getEvents(event) {
      if (
        event.view != this.calView ||
        event.startDate.toMySqlDate() != this.startDate ||
        event.endDate.toMySqlDate() != this.endDate
      ) {
        this.setStartDate(event.startDate.toMySqlDate());
        this.setEndDate(event.endDate.toMySqlDate());
        this.setCalView(event.view);
        this.fetch();
      }
    },
    onEventClick(event) {
      if (!event.clickable) return;

      if (event.assignment) {
        this.$buefy.dialog.alert({
          title: event.assignment.task.name,
          message: `Location: ${event.assignment.task.location}
                    <br>Time: ${event.assignment.task.start_at} – ${event.assignment.task.end_at}
                    <br>Description: ${event.assignment.task.description}
                    <br>Hours: ${event.assignment.hours}
                    <br>Status: ${event.assignment.state.name}`,
          type: this.stateType(event.assignment.state)
        });
      }
    },
    onExport() {},
    ...mapActions("calendar", ["fetchEvents"]),
    ...mapMutations("calendar", ["setStartDate", "setEndDate", "setCalView"])
  },

  computed: {
    eventsForCalendar() {
      var events = this.conferenceDays.map(day => {
        return {
          start: day.date.toMySqlDate(),
          end: day.date.toMySqlDate(),
          title: `${day.name} (${day.dayNumber})`,
          class: "vuecal__conference-day",
          allDay: true,
          clickable: false
        };
      });
      if (this.userEvents?.assignments) {
        this.userEvents.assignments.forEach(assignment => {
          var start =
            this.dateFromMySql(assignment.task.date).toMySqlDate() +
            " " +
            assignment.task.start_at;
          var end =
            this.dateFromMySql(assignment.task.date).toMySqlDate() +
            " " +
            assignment.task.end_at;
          events.push({
            start,
            end,
            title: `${assignment.task.name}`,
            assignment,
            class: `is-hoverable-overflow is-clickable vuecal__assignment vuecal__assignment-${assignment.state.name}`,
            clickable: true
          });
        });
      }

      return events;
    },
    ...mapGetters("conferences", ["conferenceDays"]),
    ...mapGetters("conference", {
      lastConference: "conference",
      taskDays: "taskDays"
    }),
    ...mapGetters("calendar", {
      userEvents: "events",
      startDate: "startDate",
      endDate: "endDate",
      calView: "calView"
    })
  }
};
</script>