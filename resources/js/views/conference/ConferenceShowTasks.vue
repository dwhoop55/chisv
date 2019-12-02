<template>
  <div>
    <b-field grouped group-multiline>
      <b-datepicker
        :date-formatter="dateFormatter"
        :loading="isLoadingCalendar"
        @input="getTasks()"
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
        @input="debounceGetTasks()"
        v-model="searchString"
        placeholder="Search.."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        v-if="canCreateTask"
        :disabled="isLoading"
        class="control"
        @active-change="($event == false) ? getTasks() : null"
        v-model="selectedPriorities"
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

      <b-dropdown
        :value="activeColumns"
        @input="$store.commit('TASKS_COLUMNS', $event)"
        multiple
        aria-role="list"
      >
        <button class="button is-primary" slot="trigger">
          <span>Columns {{ activeColumns.length }}/{{ canCreateTask ? '5' : '2'}}</span>
          <b-icon icon="menu-down"></b-icon>
        </button>

        <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="manage">Manage</b-dropdown-item>
        <b-dropdown-item aria-role="listitem" value="location">Location</b-dropdown-item>
        <b-dropdown-item aria-role="listitem" value="description">Description</b-dropdown-item>
        <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="slots">Slots</b-dropdown-item>
        <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="priority">Priority</b-dropdown-item>
      </b-dropdown>
    </b-field>
    <br />

    <b-table
      @page-change="onPageChange"
      @sort="onSort"
      ref="table"
      :data="tasks"
      detail-key="id"
      :show-detail-icon="true"
      paginated
      backend-pagination
      :total="totalTasks"
      :per-page="perPage"
      :loading="isLoading"
      :hoverable="true"
      backend-sorting
      default-sort="tasks.start_at"
      sort-icon="chevron-up"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
    >
      <template slot-scope="props">
        <b-table-column
          :visible="canCreateTask && activeColumns.includes('manage')"
          width="150"
          label="Manage"
        >
          <b-button @click="editTask(props.row)" outlined size="is-small" type="is-primary">Edit</b-button>
          <b-button
            @click="confirmDeleteTask(props.row)"
            outlined
            size="is-small"
            type="is-danger"
          >Delete</b-button>
        </b-table-column>
        <b-table-column width="190" label="Your preference">
          <template slot="header" slot-scope="{ column }">
            <b-tooltip label="X=impossible, 1=low, 2=medium, 3=high" dashed>{{ column.label }}</b-tooltip>
          </template>
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

      <template slot="detail" slot-scope="props">
        <p>{{ props.row.description }}</p>
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
          </div>
        </section>
      </template>

      <template slot="bottom-left">
        <small
          class="has-text-weight-light"
        >{{ totalTasks > 0 ? totalTasks : 'No' }} {{ totalTasks == 1 ? 'task' : 'tasks' }} for {{ this.day | moment('ll') }}</small>
      </template>

      <template slot="footer">
        <div class="has-text-right">
          <b-dropdown @change="perPage=$event;getTasks()" :value="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="5" aria-role="listitem">5 per page</b-dropdown-item>
            <b-dropdown-item value="10" aria-role="listitem">10 per page</b-dropdown-item>
            <b-dropdown-item value="20" aria-role="listitem">20 per page</b-dropdown-item>
            <b-dropdown-item value="30" aria-role="listitem">30 per page</b-dropdown-item>
            <b-dropdown-item value="40" aria-role="listitem">40 per page</b-dropdown-item>
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

export default {
  props: ["conference"],

  data() {
    return {
      tasks: [],
      taskDays: [],
      totalTasks: null,
      searchString: this.$store.getters.tasksSearch,
      day: new Date(),
      selectedPriorities: [1, 2, 3],
      allPriorities: [1, 2, 3],
      sortField: "tasks.start_at",
      sortOrder: "asc",
      perPage: 10,
      page: 1,

      isLoading: true,
      isLoadingCalendar: true,

      ignoreNextToggleClick: false,

      canCreateTask: false
    };
  },

  methods: {
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
              end_at: "09:00:00",
              hours: 0,
              priority: 1,
              slots: 1,
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
      console.log(task);
      this.isLoading = true;
      api
        .deleteTask(task.id)
        .then(data => {
          this.getTasks();
          this.getTaskDays();
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
      const params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortOrder}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `search_string=${this.searchString}`,
        `priorities=${this.selectedPriorities}`,
        `day=${this.day.toMySqlDate()}`
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
      this.page = page;
      this.getTasks();
    },
    onSort(field, order) {
      this.sortField = field;
      this.sortOrder = order;
      this.getTasks();
    },
    debounceGetTasks: debounce(function() {
      this.getTasks();
      this.$store.commit("TASKS_SEARCH", this.searchString);
    }, 250),
    toggle: function(row) {
      if (this.ignoreNextToggleClick) {
        this.ignoreNextToggleClick = false;
      } else {
        this.$refs.table.toggleDetails(row);
      }
    },
    dateFormatter(date) {
      return `Tasks for ${date.toLocaleDateString()}`;
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
      var start = new Date(this.conference.start_date);
      var end = new Date(this.conference.end_date);
      var loop = new Date(start);

      for (var d = start; d <= end; d.setDate(d.getDate() + 1)) {
        days.push({
          date: new Date(d),
          type: "is-primary"
        });
      }

      for (var day in this.taskDays) {
        if (this.taskDays.hasOwnProperty(day)) {
          days.push({
            date: new Date(day),
            type: "is-warning"
          });
        }
      }

      return days;
    }
  }
};
</script>
