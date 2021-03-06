<template>
  <div>
    <b-field grouped group-multiline>
      <b-datepicker
        @input="onDayChange($event)"
        :value="day"
        :events="calendarEvents"
        indicators="bars"
        :mobile-native="false"
      >
        <template>
          <small>Legend</small>
          <br />
          <b-tag rounded type="is-primary">Conference days</b-tag>
          <b-tag rounded type="is-warning">Day with tasks</b-tag>
        </template>
      </b-datepicker>

      <timespan-picker
        :value="interval"
        placeholder="Limit time"
        @input="setInterval($event);reload()"
        class="control"
        :incrementMinutes="15"
      ></timespan-picker>

      <b-field expanded>
        <b-input
          expanded
          width="600"
          v-debounce.fireonempty="onSearch"
          :value="search"
          placeholder="Search name, SV or location"
          type="search"
          icon="magnify"
        ></b-input>
        <p class="control">
          <b-button @click="showSearchHelp()">
            <b-icon type="is-primary" size="is-small" icon="help"></b-icon>
          </b-button>
        </p>
      </b-field>

      <b-field v-if="canRunAuction">
        <b-button
          :disabled="isLoading"
          @click="runAuction()"
          type="is-primary"
        >Fill free Tasks of this day (Auction)</b-button>
      </b-field>

      <b-field v-if="canRunAuction">
        <b-button
          :disabled="isLoading"
          @click="deleteAllAssignments()"
          type="is-danger"
        >Delete all Assignments of this day</b-button>
      </b-field>

      <b-field expanded></b-field>

      <b-field position="is-right">
        <b-button
          :disabled="isLoading"
          @click="reload()"
          type="is-primary"
          icon-left="refresh"
        >Reload</b-button>
      </b-field>
    </b-field>
    <br />

    <b-table
      v-if="!hackHideTable"
      @page-change="onPageChange"
      @sort="onSort"
      ref="table"
      pagination-position="both"
      :data="tasks"
      paginated
      backend-pagination
      :total="totalTasks"
      :per-page="perPage"
      :current-page="page"
      :loading="isLoading"
      :hoverable="true"
      backend-sorting
      :mobile-cards="false"
      :default-sort="sortField"
      :default-sort-direction="sortDirection"
      sort-icon="chevron-up"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
    >
      <template slot="top-left">
        <b-dropdown :value="columns" @input="setColumns($event)" multiple aria-role="list">
          <div slot="trigger" class="is-vertical-center is-clickable">
            <b-icon icon="dots-vertical"></b-icon>Columns
          </div>

          <b-dropdown-item aria-role="listitem" value="start_at">Start</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="end_at">End</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="hours">Hours</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="name">Name</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="location">Location</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="description">Description</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="slots">Slots</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="priority">Priority</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="assignments">Assignments</b-dropdown-item>
        </b-dropdown>
      </template>
      <template slot-scope="props">
        <b-table-column
          :visible="columns.includes('start_at')"
          field="tasks.start_at"
          width="93"
          sortable
          label="Starts"
        >
          {{ momentize(
          props.row.start_at,
          {format: 'LT', fromToTz: conference.timezone.name}
          ) }}
        </b-table-column>
        <b-table-column
          :visible="columns.includes('end_at')"
          field="tasks.end_at"
          sortable
          width="93"
          label="Ends"
        >
          {{ momentize(
          props.row.end_at,
          {format: 'LT', fromToTz: conference.timezone.name}
          ) }}
        </b-table-column>
        <b-table-column
          :visible="columns.includes('hours')"
          field="tasks.hours"
          width="10"
          sortable
          label="Hours"
        >{{ hoursFromTime(timeFromDecimal(props.row.hours)) }}</b-table-column>
        <b-table-column
          :visible="columns.includes('name')"
          field="tasks.name"
          sortable
          label="Name"
        >{{ props.row.name }}</b-table-column>
        <b-table-column
          :visible="columns.includes('location')"
          field="tasks.location"
          sortable
          label="Location"
        >{{ props.row.location }}</b-table-column>
        <b-table-column
          :visible="columns.includes('description')"
          field="tasks.description"
          sortable
          label="Description"
        >
          <a
            @click.prevent="showDescription(props.row)"
          >{{ props.row.description | textlimit(40) }} {{ (props.row.description && props.row.description.length > 40) ? ' (more)' : '' }}</a>
        </b-table-column>
        <b-table-column
          :visible="columns.includes('slots')"
          field="tasks.slots"
          width="80"
          sortable
          label="Slots"
        >
          <p
            :class="{
               'has-text-danger has-text-weight-bold': props.row.assignments.length == 0,
               'has-text-warning has-text-weight-bold': props.row.assignments.length > props.row.slots,
               'has-text-success': props.row.assignments.length == props.row.slots,
            }"
          >{{ props.row.assignments.length }} / {{ props.row.slots }}</p>
        </b-table-column>
        <b-table-column
          :visible="columns.includes('priority')"
          field="tasks.priority"
          width="10"
          sortable
          label="Priority"
        >{{ props.row.priority }}</b-table-column>
        <b-table-column
          class="is-marginless is-paddingless"
          :visible="columns.includes('assignments')"
          label="Assignments"
          width="700"
        >
          <task-assignments-component
            :task="props.row"
            :conference="conference"
            :users="users"
            @reload="reload()"
            @updateHours="users[$event.userId].hours_done += $event.hours"
          ></task-assignments-component>
        </b-table-column>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p>
              No tasks found for
              <b v-if="search.length > 0">{{ search }}</b>
              on {{ momentize(day, {format: 'll', fromToTz: conference.timezone.name}) }}
            </p>
          </div>
        </section>
      </template>

      <template slot="bottom-left">
        <small
          class="has-text-weight-light"
        >{{ totalTasks }} task{{ totalTasks > 1 ? 's' : '' }} matching criteria</small>
      </template>

      <template slot="footer">
        <div class="has-text-left">
          <b-dropdown @change="onPerPageChange" :value="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="5" aria-role="listitem">5 per page</b-dropdown-item>
            <b-dropdown-item value="10" aria-role="listitem">10 per page</b-dropdown-item>
            <b-dropdown-item value="30" aria-role="listitem">30 per page</b-dropdown-item>
            <b-dropdown-item value="60" aria-role="listitem">60 per page</b-dropdown-item>
            <b-dropdown-item value="150" aria-role="listitem">150 per page</b-dropdown-item>
            <b-dropdown-item value="300" aria-role="listitem">300 per page</b-dropdown-item>
          </b-dropdown>
        </div>
      </template>
    </b-table>
  </div>
</template>

<script>
import api from "@/api.js";
import JobModalVue from "@/components/modals/JobModal.vue";
import { mapGetters, mapActions, mapMutations } from "vuex";

export default {
  props: ["conference"],

  data() {
    return {
      isLoading: true,
      timer: null,
      hackHideTable: false // This is part of the hotfix for buefy table bug
    };
  },

  beforeDestroy() {
    clearInterval(this.timer);
  },

  methods: {
    reload() {
      this.isLoading = true;
      this.fetchAssignments().then(() => (this.isLoading = false));
    },
    autoRefresh() {
      this.fetchAssignments(this.conference.key, false).then(
        () => (this.timer = setTimeout(this.autoRefresh, 10000))
      );
    },
    deleteAllAssignments() {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message:
          "Are you sure you want to <b>delete all assignments of every single SV for this day</b> This action cannot be undone.",
        confirmText: "Yes, delete all assignments of every SV",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          api
            .deleteAllAssignmentsOfConference(
              this.conference.key,
              this.day.toMySqlDate()
            )
            .then(data => {
              this.$buefy.notification.open({
                indefinite: true,
                message: data.data.message,
                type: "is-success",
                hasIcon: true
              });
            })
            .finally(() => this.reload());
        } // onConfirm
      });
    },
    runAuction() {
      api
        .runAuction(this.conference.key, this.day.toMySqlDate())
        .then(data => {
          let jobId = data.data.result;
          this.$buefy.modal.open({
            parent: this,
            props: { id: jobId },
            component: JobModalVue,
            hasModalCard: true,
            onCancel: () => this.reload()
          });
        })
        .finally(() => this.reload());
    },
    showSearchHelp() {
      this.$buefy.dialog.alert(
        "You can search all task assignments of the current day for:\
            <li>Task name</li>\
            <li>Task location</li>\
            <li>SVs firstname</li>\
            <li>SVs lastname</li>"
      );
    },
    onPageChange(page) {
      this.setPage(page);
      this.reload();
    },
    onPerPageChange(perPage) {
      this.setPerPage(perPage);
      this.reload();
    },
    onSort(field, direction) {
      this.setSortField(field);
      this.setSortDirection(direction);
      this.reload();
    },
    onDayChange(day) {
      this.setDay(day);
      this.onPageChange(1);
    },
    onSearch(search) {
      this.setSearch(search);
      this.reload();
    },
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    },
    ...mapActions("assignments", ["fetchAssignments"]),
    ...mapMutations("assignments", [
      "setColumns",
      "setSearch",
      "setDay",
      "setInterval",
      "setSortField",
      "setSortDirection",
      "setPerPage",
      "setPage"
    ])
  },

  created() {
    this.$watch("tasks", function(newVal, oldVal) {
      /* This is a workaround for the bug present in
       * buefy 0.8.17+ (- 0.9.0) which breaks column show/hide
       * when the table was empty once
       * After it has been fixed in buefy remove this 'hack
       */
      if (oldVal?.length == 0 && newVal?.length > 1) {
        console.log("Hotfixing buefy table");
        this.hackHideTable = true;
        setTimeout(() => (this.hackHideTable = false), 10);
      }
    });

    this.reload();
    this.autoRefresh();
  },

  computed: {
    canRunAuction() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    calendarEvents() {
      return [...this.conferenceDays, ...this.taskDays];
    },
    ...mapGetters("assignments", [
      "columns",
      "search",
      "day",
      "interval",
      "sortField",
      "sortDirection",
      "perPage",
      "page",
      "users",
      "tasks",
      "totalTasks",
      "data"
    ]),
    ...mapGetters("conference", ["conferenceDays", "taskDays"]),
    ...mapGetters("auth", ["userIs"])
  }
};
</script>
