<template>
  <div>
    <b-field grouped group-multiline>
      <b-datepicker
        :loading="isLoading"
        @input="onDayChange(day)"
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

      <b-field>
        <b-input
          width="600"
          @input="onSearch($event)"
          v-model="searchString"
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
        <b-dropdown
          :value="activeColumns"
          @input="$store.commit('ASSIGNMENTS_COLUMNS', $event)"
          multiple
          aria-role="list"
        >
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
          @click="getTasks()"
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
      :data="tasks"
      paginated
      backend-pagination
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
          :visible="activeColumns.includes('start_at')"
          field="tasks.start_at"
          width="10"
          sortable
          label="Starts"
        >{{ hoursFromTime(props.row.start_at) }}</b-table-column>
        <b-table-column
          :visible="activeColumns.includes('end_at')"
          field="tasks.end_at"
          sortable
          width="10"
          label="Ends"
        >{{ hoursFromTime(props.row.end_at) }}</b-table-column>
        <b-table-column
          :visible="activeColumns.includes('hours')"
          field="tasks.hours"
          width="10"
          sortable
          label="Hours"
        >{{ hoursFromTime(timeFromDecimal(props.row.hours)) }}</b-table-column>
        <b-table-column
          :visible="activeColumns.includes('name')"
          field="tasks.name"
          sortable
          label="Name"
        >{{ props.row.name }}</b-table-column>
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
          :visible="activeColumns.includes('slots')"
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
          :visible="activeColumns.includes('priority')"
          field="tasks.priority"
          width="10"
          sortable
          label="Priority"
        >{{ props.row.priority }}</b-table-column>
        <b-table-column
          class="is-marginless is-paddingless"
          :visible="activeColumns.includes('assignments')"
          label="Assignments"
          width="700"
        >
          <task-assignments-component
            :task="props.row"
            :conference="conference"
            :users="users"
            @reload="getTasks()"
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
              <b v-if="searchString.length > 0">{{ searchString }}</b>
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

export default {
  props: ["conference"],

  data() {
    return {
      users: [],
      tasks: [],
      taskDays: [],
      totalTasks: null,
      searchString: this.$store.getters.assignmentsSearch,
      day: new Date(this.$store.getters.assignmentsDay),
      sortField: this.$store.getters.assignmentsSortField,
      sortDirection: this.$store.getters.assignmentsSortDirection,
      perPage: this.$store.getters.assignmentsPerPage,
      page: this.$store.getters.assignmentsPage,

      isLoading: true,

      canRunAuction: false,

      ignoreNextToggleClick: false
    };
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
            .updateConferenceDeleteAllAssignments(
              this.conference.key,
              this.day.toMySqlDate()
            )
            .then(data => {
              let jobId = data.data.result;
              this.$buefy.modal.open({
                parent: this,
                props: { id: jobId },
                component: JobModalVue,
                hasModalCard: true,
                onCancel: () => {
                  this.getTasks();
                }
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
              this.getTasks();
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
          this.isLoading = false;
          this.getTasks();
        });
    },
    getCan: async function() {
      this.canRunAuction = await auth.can(
        "runAuction",
        "Conference",
        this.conference.id
      );
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
    getTasks() {
      const params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortDirection}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `search_string=${this.searchString}`,
        `day=${this.day.toMySqlDate()}`
      ].join("&");

      this.isLoading = true;
      api
        .getConferenceAssignments(this.conference.key, `?${params}`)
        .then(({ data }) => {
          this.users = data.users;
          this.tasks = data.tasks;
          this.taskDays = data.task_days;
          this.totalTasks = data.total;
        })
        .catch(error => {
          this.tasks = [];
          this.users = [];
          this.totalTasks = 0;
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    onPageChange(page) {
      this.$store.commit("ASSIGNMENTS_PAGE", page);
      this.page = page;
      this.getTasks();
    },
    onPerPageChange(perPage) {
      this.$store.commit("ASSIGNMENTS_PER_PAGE", perPage);
      this.onPageChange(1);
      this.perPage = perPage;
      this.getTasks();
    },
    onSort(field, direction) {
      this.sortField = field;
      this.sortDirection = direction;
      this.$store.commit("ASSIGNMENTS_SORT_FIELD", field);
      this.$store.commit("ASSIGNMENTS_SORT_DIRECTION", direction);
      this.getTasks();
    },
    onDayChange(day) {
      this.$store.commit("ASSIGNMENTS_DAY", day);
      this.onPageChange(1);
    },
    onSearch(search) {
      this.onPageChange(1);
      this.debounceGetTasks(search);
    },
    debounceGetTasks: debounce(function() {
      this.$store.commit("ASSIGNMENTS_SEARCH", this.searchString);
      this.getTasks();
    }, 250),
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    }
  },

  created() {
    this.getTasks();
    this.getCan();
  },

  computed: {
    activeColumns() {
      return this.$store.getters.assignmentsColumns;
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
