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

      <b-field>
        <b-input
          width="600"
          v-debounce.fireonempty="onSearch"
          :value="search"
          placeholder="Search.."
          type="search"
          icon="magnify"
        ></b-input>
        <p class="control">
          <button @click="showSearchHelp()" class="button">
            <b-icon type="is-primary" size="is-small" icon="help"></b-icon>
          </button>
        </p>
      </b-field>

      <b-field>
        <b-dropdown :value="columns" @input="setColumns($event)" multiple aria-role="list">
          <button :disabled="isLoading" class="button is-primary" slot="trigger">
            <span>Visible columns</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

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
          @click="fetchAssignments()"
          type="is-primary"
          icon-left="refresh"
        >Reload</b-button>
      </b-field>
    </b-field>
    <br />

    <b-table
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
      <template slot-scope="props">
        <b-table-column
          :visible="columns.includes('start_at')"
          field="tasks.start_at"
          width="10"
          sortable
          label="Starts"
        >{{ hoursFromTime(props.row.start_at) }}</b-table-column>
        <b-table-column
          :visible="columns.includes('end_at')"
          field="tasks.end_at"
          sortable
          width="10"
          label="Ends"
        >{{ hoursFromTime(props.row.end_at) }}</b-table-column>
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
            @reload="fetchAssignments()"
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
              {{ day | moment('ll') }}
            </p>
          </div>
        </section>
      </template>

      <template slot="bottom-left">
        <small
          class="has-text-weight-light"
        >Found {{ totalTasks }} task{{ totalTasks > 1 ? 's' : '' }}</small>
      </template>

      <template slot="footer">
        <div class="has-text-right">
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
import auth from "@/auth.js";
import JobModalVue from "@/components/modals/JobModal.vue";
import { mapGetters, mapActions, mapMutations } from "vuex";

export default {
  props: ["conference"],

  data() {
    return {};
  },

  methods: {
    deleteAllAssignments() {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message:
          "Are you sure you want to <b>delete all assignments of every single SV for this day</b> This action cannot be undone.",
        confirmText: "Yes, delete all assignments of every SV",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          this.isLoading = true;
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
            .catch(error => {
              this.$buefy.notification.open({
                duration: 5000,
                message: error.message,
                type: "is-danger",
                hasIcon: true
              });
            })
            .finally(() => {
              this.fetchAssignments();
            });
        } // onConfirm
      });
    },
    runAuction() {
      this.isLoading = true;
      api
        .runAuction(this.conference.key, this.day.toMySqlDate())
        .then(data => {
          let jobId = data.data.result;
          this.$buefy.modal.open({
            parent: this,
            props: { id: jobId },
            component: JobModalVue,
            hasModalCard: true,
            onCancel: () => {
              this.fetchAssignments();
            }
          });
        })
        .catch(error => {
          var message = error.response.data.message
            ? error.response.data.message
            : error.message;
          this.$buefy.notification.open({
            duration: 5000,
            message: message,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.fetchAssignments();
        });
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
      this.fetchAssignments();
    },
    onPerPageChange(perPage) {
      this.setPerPage(page);
      this.fetchAssignments();
    },
    onSort(field, direction) {
      this.setSortField(field);
      this.setSortDirection(direction);
      this.fetchAssignments();
    },
    onDayChange(day) {
      this.setDay(day);
      console.log(day);
      this.onPageChange(1);
    },
    onSearch(search) {
      this.setSearch(search);
      this.fetchAssignments();
    },
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    },
    ...mapActions("assignments", ["fetchAssignments"]),
    ...mapMutations("assignments", {
      setColumns: "setColumns",
      setSearch: "setSearch",
      setDay: "setDay",
      setSortField: "setSortField",
      setSortDirection: "setSortDirection",
      setPerPage: "setPerPage",
      setPage: "setPage"
    })
  },

  created() {
    this.fetchAssignments(this.conference.key);
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
      "sortField",
      "sortDirection",
      "perPage",
      "page",
      "users",
      "tasks",
      "totalTasks",
      "data",
      "isLoading"
    ]),
    ...mapGetters("conference", ["conferenceDays", "taskDays"]),
    ...mapGetters("auth", ["userIs"])
  }
};
</script>
