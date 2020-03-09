<template>
  <div>
    <b-field grouped group-multiline>
      <b-datepicker
        :loading="isLoadingCalendar"
        @input="onDayChange()"
        v-model="day"
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
        v-model="searchString"
        placeholder="Search.."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        v-if="canCreateTask"
        @input="onPrioritiesChange"
        @active-change="($event == false) ? getTasks() : null"
        :value="selectedPriorities"
        :disabled="isLoading"
        class="control"
        multiple
        aria-role="list"
      >
        <button class="button" type="button" slot="trigger">
          <span>Priorities {{ selectedPriorities.length }} / {{ allPriorities.length }}</span>
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
        <b-dropdown
          :value="activeColumns"
          @input="$store.commit('TASKS_COLUMNS', $event)"
          multiple
          aria-role="list"
        >
          <button class="button is-primary" slot="trigger">
            <span>Visible columns</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

          <b-dropdown-item
            v-if="canCreateTask || canDeleteTask"
            aria-role="listitem"
            value="manage"
          >Manage</b-dropdown-item>
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
        <b-button @click="getTasks();getTaskDays()" type="is-primary" icon-left="refresh">Reload</b-button>
      </b-field>
    </b-field>
    <br />

    <b-table
      @page-change="onPageChange"
      @sort="onSort"
      ref="table"
      :data="tasks"
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
          :visible="(canCreateTask || canDeleteTask) && activeColumns.includes('manage')"
          width="150"
          label="Manage"
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
        <b-table-column
          :width="conference.bidding_enabled ? 315 : 0"
          :label="conference.bidding_enabled ? 'Preference' : 'Status'"
        >
          <task-bid-picker @error="getTasks()" size="is-small" v-model="props.row"></task-bid-picker>
        </b-table-column>
        <b-table-column
          field="tasks.start_at"
          width="10"
          sortable
          label="Starts"
        >{{ hoursFromTime(props.row.start_at) }}</b-table-column>
        <b-table-column
          field="tasks.end_at"
          sortable
          width="10"
          label="Ends"
        >{{ hoursFromTime(props.row.end_at) }}</b-table-column>
        <b-table-column
          field="tasks.hours"
          width="10"
          sortable
          label="Hours"
        >{{ hoursFromTime(timeFromDecimal(props.row.hours)) }}</b-table-column>
        <b-table-column field="tasks.name" sortable label="Name">{{ props.row.name }}</b-table-column>
        <b-table-column
          :visible="activeColumns.includes('location')"
          field="tasks.location"
          sortable
          label="Location"
        >{{ props.row.location }}</b-table-column>
        <b-table-column
          :visible="activeColumns.includes('description')"
          field="tasks.description"
          sortable
          label="Description"
        >
          <a
            @click.prevent="showDescription(props.row)"
          >{{ props.row.description | textlimit(40) }} {{ (props.row.description && props.row.description.length > 40) ? ' (more)' : '' }}</a>
        </b-table-column>
        <b-table-column
          :visible="canCreateTask && activeColumns.includes('slots')"
          field="tasks.slots"
          width="10"
          sortable
          label="Slots"
        >{{ props.row.slots }}</b-table-column>
        <b-table-column
          :visible="canCreateTask && activeColumns.includes('priority')"
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
              <b v-if="searchString.length > 0">{{ searchString }}</b>
              {{ day | moment('ll') }}
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
        <div class="has-text-right">
          <b-dropdown @change="onPerPageChange" :value="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="5" aria-role="listitem">5 per page</b-dropdown-item>
            <b-dropdown-item value="10" aria-role="listitem">10 per page</b-dropdown-item>
            <b-dropdown-item value="20" aria-role="listitem">20 per page</b-dropdown-item>
            <b-dropdown-item value="50" aria-role="listitem">50 per page</b-dropdown-item>
          </b-dropdown>
        </div>
      </template>
    </b-table>
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";
import TaskModalVue from "@/components/modals/TaskModal.vue";
import TasksImportModalVue from "../../components/modals/TasksImportModal.vue";
import JobModalVue from "../../components/modals/JobModal.vue";
import moment from "moment-timezone";

export default {
  props: ["conference"],

  data() {
    return {
      tasks: [],
      taskDays: [],
      totalTasks: null,
      searchString: this.$store.getters.tasksSearch,
      day: new Date(this.$store.getters.tasksDay),
      selectedPriorities: this.$store.getters.tasksPriorities,
      allPriorities: [1, 2, 3],
      sortField: this.$store.getters.tasksSortField,
      sortDirection: this.$store.getters.tasksSortDirection,
      perPage: this.$store.getters.tasksPerPage,
      page: this.$store.getters.tasksPage,
      onlyOwnTasks: this.$store.getters.tasksOnlyOwnTasks,

      isLoading: true,
      isLoadingCalendar: true,

      canCreateTask: false,
      canDeleteTask: false
    };
  },

  methods: {
    deleteAllTasks() {
      let day = new moment(this.day).format("DD.MM.YYYY");
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
              this.isLoading = true;
              api
                .deleteAllTasksOfConference(
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
                  this.isLoading = false;
                  this.getTasks();
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
              date: new Date().toMySqlDate(),
              start_at: "09:00:00",
              end_at: "10:00:00",
              hours: 1,
              priority: 1,
              slots: 2,
              conference_id: this.conference.id
            },
            updated: () => {
              this.getTasks();
              this.getTaskDays();
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
                  this.getTasks();
                  this.getTaskDays();
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
            this.getTasks();
            this.getTaskDays();
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
      this.isLoading = true;
      api
        .deleteTask(task.id)
        .then(data => {
          this.$buefy.notification.open({
            duration: 5000,
            message: data.data.message,
            type: "is-success",
            hasIcon: true
          });
          this.getTasks();
          this.getTaskDays();
        })
        .catch(error => {
          var message = error.response.data.message
            ? error.response.data.message
            : error.message;
          this.$buefy.notification.open({
            indefinite: true,
            message: message,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    getCan: async function() {
      this.canCreateTask = await auth.can(
        "createForConference",
        "Task",
        null,
        "Conference",
        this.conference.id
      );
      this.canDeleteTask = await auth.can(
        "deleteForConference",
        "Task",
        null,
        "Conference",
        this.conference.id
      );
    },
    getTaskDays() {
      this.isLoadingCalendar = true;
      api
        .getConferenceTaskDays(this.conference.key)
        .then(data => {
          this.taskDays = data.data;
        })
        .catch(error => {
          console.error(error);
        })
        .finally(() => {
          this.isLoadingCalendar = false;
        });
    },
    getTasks() {
      this.$store.commit("TASKS_DAY", this.day);

      const params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortDirection}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `search_string=${this.searchString}`,
        `priorities=${this.selectedPriorities}`,
        `day=${this.day.toMySqlDate()}`,
        `only_own_tasks=${this.onlyOwnTasks}`
      ].join("&");

      this.isLoading = true;
      api
        .getConferenceTasks(this.conference.key, `?${params}`)
        .then(({ data }) => {
          this.tasks = data.data;
          this.totalTasks = data.total;
        })
        .catch(error => {
          this.tasks = [];
          this.totalTasks = 0;
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    onPageChange(page) {
      this.$store.commit("TASKS_PAGE", page);
      this.page = page;
      this.getTasks();
    },
    onPerPageChange(perPage) {
      this.$store.commit("TASKS_PER_PAGE", perPage);
      this.perPage = perPage;
      this.getTasks();
    },
    onSort(field, direction) {
      this.sortField = field;
      this.sortDirection = direction;
      this.$store.commit("TASKS_SORT_FIELD", field);
      this.$store.commit("TASKS_SORT_DIRECTION", direction);
      this.getTasks();
    },
    onPrioritiesChange(priorities) {
      this.$store.commit("TASKS_PRIORITIES", priorities);
      this.selectedPriorities = priorities;
    },
    onDayChange() {
      this.onPageChange(1);
    },
    onOnlyOwnTasksChange(bool) {
      this.$store.commit("TASKS_ONLY_OWN_TASKS", bool);
      this.onlyOwnTasks = bool;
      this.getTasks();
    },
    onSearch(search) {
      this.$store.commit("TASKS_SEARCH", this.searchString);
      this.getTasks();
    },
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    }
  },

  created() {
    this.getTasks();
    this.getTaskDays();
    this.getCan();
  },

  computed: {
    activeColumns() {
      return this.$store.getters.tasksColumns;
    },
    calendarEvents() {
      if (!this.conference.start_date || !this.conference.end_date) {
        return null;
      }

      var days = [];
      var start = this.dateFromMySql(this.conference.start_date);
      var end = this.dateFromMySql(this.conference.end_date);
      var loop = new Date(start);

      for (var d = start; d <= end; d.setDate(d.getDate() + 1)) {
        days.push({
          date: new Date(d),
          type: "is-primary"
        });
      }

      Object.keys(this.taskDays).forEach(function(day) {
        days.push({
          date: new Date(day),
          type: "is-warning"
        });
      });

      return days;
    }
  }
};
</script>
