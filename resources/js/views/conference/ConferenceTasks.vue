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

      <b-input
        width="600"
        v-debounce.fireonempty="onSearch"
        :value="search"
        placeholder="Search.."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        v-if="canCreateTask"
        @input="onPrioritiesChange"
        @active-change="($event == false) ? fetchTasks() : null"
        :value="priorities"
        :disabled="isLoading"
        class="control"
        multiple
        aria-role="list"
      >
        <button class="button" type="button" slot="trigger">
          <span>Priorities {{ priorities.length }} / {{ allPriorities.length }}</span>
          <b-icon icon="menu-down"></b-icon>
        </button>
        <b-dropdown-item
          :disabled="isLoading"
          v-for="priority in allPriorities"
          :key="priority"
          :value="priority"
          aria-role="listitem"
        >
          <p>{{ priority }}</p>
        </b-dropdown-item>
      </b-dropdown>

      <b-button
        class="control"
        @click="createTask('single')"
        type="is-primary"
        v-if="canCreateTask"
      >New task</b-button>

      <b-button
        class="control"
        @click="createTask('multiple')"
        type="is-primary"
        v-if="canCreateTask"
      >Import task</b-button>

      <b-field>
        <b-dropdown :value="columns" @input="setColumns($event)" multiple aria-role="list">
          <button class="button is-primary" slot="trigger">
            <span>Visible columns</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

          <b-dropdown-item
            v-if="canCreateTask || canDeleteTask"
            aria-role="listitem"
            value="manage"
          >Manage</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="start_at">Starts</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="end_at">Ends</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="hours">Hours</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="location">Location</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="description">Description</b-dropdown-item>
          <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="slots">Slots</b-dropdown-item>
          <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="priority">Priority</b-dropdown-item>
        </b-dropdown>
      </b-field>

      <b-field v-if="canDeleteTask">
        <b-button
          :disabled="isLoading"
          @click="deleteAllTasks()"
          type="is-danger"
        >Delete all Tasks of this day</b-button>
      </b-field>

      <b-field class="is-vertical-center">
        <b-checkbox
          @input="onOnlyOwnTasksChange($event)"
          :value="onlyOwnTasks"
          :type="onlyOwnTasks ? 'is-danger' : 'is-primary'"
        >Show only my assigned tasks</b-checkbox>
      </b-field>

      <b-field expanded></b-field>

      <b-field position="is-right">
        <b-button @click="fetchTasks();fetchTaskDays()" type="is-primary" icon-left="refresh">Reload</b-button>
      </b-field>
    </b-field>
    <br />

    <b-table
      narrowed
      @page-change="onPageChange"
      @sort="onSort"
      ref="table"
      :data="tasks"
      :mobile-cards="false"
      paginated
      backend-pagination
      pagination-position="both"
      :total="totalTasks"
      :per-page="perPage"
      :current-page="page"
      :loading="isLoading"
      :hoverable="true"
      backend-sorting
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
          :visible="(canCreateTask || canDeleteTask) && columns.includes('manage')"
          label="Manage"
          width="128"
        >
          <b-button
            v-if="canCreateTask"
            @click="editTask(props.row)"
            outlined
            size="is-small"
            type="is-primary"
          >Edit</b-button>
          <b-button
            v-if="canDeleteTask"
            @click="confirmDeleteTask(props.row)"
            outlined
            size="is-small"
            type="is-danger"
          >Delete</b-button>
        </b-table-column>
        <b-table-column width="1" :label="conference.bidding_enabled ? 'Preference' : 'Status'">
          <task-bid-picker @error="fetchTasks()" size="is-small" v-model="props.row"></task-bid-picker>
        </b-table-column>
        <b-table-column
          :visible="columns.includes('start_at')"
          field="tasks.start_at"
          width="93"
          sortable
          label="Starts"
        >
          {{ formatTime(
          dateTimeFromTime(props.row.start_at),
          'LT',
          {fromTz: conference.timezone.name}
          ) }}
        </b-table-column>
        <b-table-column
          :visible="columns.includes('end_at')"
          field="tasks.end_at"
          sortable
          width="93"
          label="Ends"
        >
          {{ formatTime(
          dateTimeFromTime(props.row.end_at),
          'LT',
          {fromTz: conference.timezone.name}
          ) }}
        </b-table-column>
        <b-table-column
          :visible="columns.includes('hours')"
          field="tasks.hours"
          width="1"
          sortable
          label="Hours"
        >{{ hoursFromTime(timeFromDecimal(props.row.hours)) }}</b-table-column>
        <b-table-column field="tasks.name" sortable label="Name">{{ props.row.name }}</b-table-column>
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
          :visible="canCreateTask && columns.includes('slots')"
          field="tasks.slots"
          width="10"
          sortable
          label="Slots"
        >{{ props.row.slots }}</b-table-column>
        <b-table-column
          :visible="canCreateTask && columns.includes('priority')"
          field="tasks.priority"
          width="10"
          sortable
          label="Priority"
        >{{ props.row.priority }}</b-table-column>
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
              on {{ formatTime(day, 'll', {fromTz: conference.timezone.name}) }}
            </p>
            <p class="has-text-danger" v-if="onlyOwnTasks">
              Only showing tasks assigned to you.
              <br />Uncheck above to see all tasks
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
        <div class="has-text-left">
          <b-dropdown @change="onPerPageChange" :value="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="5" aria-role="listitem">5 per page</b-dropdown-item>
            <b-dropdown-item value="10" aria-role="listitem">10 per page</b-dropdown-item>
            <b-dropdown-item value="20" aria-role="listitem">20 per page</b-dropdown-item>
            <b-dropdown-item value="50" aria-role="listitem">50 per page</b-dropdown-item>
            <b-dropdown-item value="100" aria-role="listitem">100 per page</b-dropdown-item>
            <b-dropdown-item value="200" aria-role="listitem">200 per page</b-dropdown-item>
            <b-dropdown-item value="300" aria-role="listitem">300 per page</b-dropdown-item>
          </b-dropdown>
        </div>
      </template>
    </b-table>
  </div>
</template>

<script>
import api from "@/api.js";
import TaskModalVue from "@/components/modals/TaskModal.vue";
import TasksImportModalVue from "../../components/modals/TasksImportModal.vue";
import JobModalVue from "../../components/modals/JobModal.vue";
import { mapGetters, mapState, mapMutations, mapActions } from "vuex";

export default {
  props: ["conference"],

  data() {
    return {
      allPriorities: [1, 2, 3]
    };
  },

  methods: {
    deleteAllTasks() {
      let day = this.formatTime(this.day, "DD.MM.YYYY", { toTz: true });
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message: `Are you sure you want to <b>delete all tasks for this day (${day})</b>?\
         <br/>This will also delete associated assignments and bids for the tasks.\
         This action cannot be undone.`,
        confirmText: "Yes, delete all tasks of this day",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          this.$buefy.dialog.confirm({
            title: "Really?",
            message: `Please confirm again that you want to <b>delete all tasks for this day (${day})</b>\
         <br/><br/>This will also delete associated assignments and bids for the tasks.\
         <br/><br/><b>This action cannot be undone.</b><br/><b>This action cannot be undone.</b>`,
            confirmText: "Yes, delete!",
            type: "is-danger",
            hasIcon: true,
            icon: "emoticon-dead",
            onConfirm: () => {
              api
                .deleteAllTasksOfConference(
                  this.conference.key,
                  this.day.toMySqlDate()
                )
                .then(({ data }) => {
                  this.$buefy.notification.open({
                    indefinite: true,
                    message: data.message,
                    type: "is-success",
                    hasIcon: true
                  });
                })
                .finally(() => {
                  this.fetchTasks();
                  this.fetchTaskDays();
                });
            } // onConfirm 2
          });
        } // onConfirm 1
      });
    },
    showHint(type) {
      switch (type) {
        case "bid":
          this.$buefy.dialog.alert(
            "This is where you can set your preference for a task. You can choose between\
            <li><strong>X</strong> unavailable</li>\
            <li><strong>1</strong> low preference</li>\
            <li><strong>2</strong> medium preference</li>\
            <li><strong>3</strong> high preference</li>"
          );
          break;
      }
    },
    createTask(type) {
      if (type == "single") {
        this.$buefy.modal.open({
          parent: this,
          props: {
            task: {
              name: "",
              location: "",
              description: "",
              date: this.dateFromMySql(this.conference.start_date),
              start_at: "09:00:00",
              end_at: "10:00:00",
              hours: 1,
              priority: 1,
              slots: 2,
              conference_id: this.conference.id
            },
            updated: () => {
              this.fetchTasks();
              this.fetchTaskDays();
            },
            calendarEvents: this.calendarEvents
          },
          component: TaskModalVue,
          hasModalCard: true
        });
      } else if (type == "multiple") {
        this.$buefy.modal.open({
          parent: this,
          props: {
            conference: this.conference,
            updated: jobId => {
              // Job dispatched, show job modal
              // and reload once that closes
              this.$buefy.modal.open({
                parent: this,
                props: { id: jobId },
                component: JobModalVue,
                hasModalCard: true,
                onCancel: () => {
                  this.fetchTasks();
                  this.fetchTaskDays();
                }
              });
            }
          },
          fullScreen: true,
          component: TasksImportModalVue,
          hasModalCard: true
        });
      }
    },
    editTask(task) {
      this.$buefy.modal.open({
        parent: this,
        props: {
          task: task,
          updated: () => {
            this.fetchTasks();
            this.fetchTaskDays();
          },
          calendarEvents: this.calendarEvents
        },
        component: TaskModalVue,
        hasModalCard: true
      });
    },
    confirmDeleteTask(task) {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message: `Are you sure you want to
        <b>permanently delete</b> the task <i>${task.name}</i>?
        <br/><br/>
        This will also remove all associated bids and assignments.
        This action cannot be undone.`,
        confirmText: "Yes, delete this task",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          this.deleteTask(task);
        }
      });
    },
    deleteTask(task) {
      api.deleteTask(task.id).then(({ data }) => {
        this.$buefy.notification.open({
          duration: 5000,
          message: data.message,
          type: "is-success",
          hasIcon: true
        });
        this.fetchTasks();
        this.fetchTaskDays();
      });
    },
    onPageChange(page) {
      this.setPage(page);
      this.fetchTasks();
    },
    onPerPageChange(perPage) {
      this.setPerPage(perPage);
      this.fetchTasks();
    },
    onSort(field, direction) {
      this.setSortField(field);
      this.setSortDirection(direction);
      this.fetchTasks();
    },
    onPrioritiesChange(priorities) {
      this.setPriorities(priorities);
    },
    onOnlyOwnTasksChange(bool) {
      this.setOnlyOwnTasks(bool);
      this.fetchTasks();
    },
    onSearch(search) {
      this.setSearch(search);
      this.fetchTasks();
    },
    onDayChange(day) {
      this.setDay(day);
      this.setPage(1);
      this.fetchTasks();
    },
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    },
    ...mapMutations("tasks", {
      setColumns: "setColumns",
      setSearch: "setSearch",
      setDay: "setDay",
      setSortField: "setSortField",
      setSortDirection: "setSortDirection",
      setPerPage: "setPerPage",
      setPage: "setPage",
      setPriorities: "setPriorities",
      setOnlyOwnTasks: "setOnlyOwnTasks"
    }),
    ...mapActions("conference", ["fetchTaskDays"]),
    ...mapActions("tasks", ["fetchTasks"])
  },

  computed: {
    canCreateTask() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    canDeleteTask() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    calendarEvents() {
      return [...this.conferenceDays, ...this.taskDays];
    },
    ...mapGetters("tasks", [
      "columns",
      "search",
      "day",
      "sortField",
      "sortDirection",
      "perPage",
      "page",
      "priorities",
      "onlyOwnTasks",
      "tasks",
      "totalTasks",
      "isLoading"
    ]),
    ...mapGetters("conference", ["conferenceDays", "taskDays"]),
    ...mapGetters("auth", ["userIs"])
  }
};
</script>
