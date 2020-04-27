<template>
  <div>
    <b-field grouped group-multiline>
      <b-datepicker
        @input="onDaysChange"
        :value="days"
        :events="calendarEvents"
        placeholder="Limit days"
        indicators="bars"
        :mobile-native="false"
        multiple
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

      <b-input
        expanded
        v-debounce.fireonempty="onSearch"
        :value="search"
        placeholder="Search name or location"
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        v-if="canChangePriorities"
        @input="onPrioritiesChange"
        @active-change="($event == false) ? reload() : null"
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

      <b-field v-if="canDeleteTask">
        <b-button
          :disabled="isLoading"
          @click="deleteAllTasks()"
          type="is-danger"
        >Delete all Tasks of the selected {{ days.length > 1 ? 'days' : 'day' }}</b-button>
      </b-field>

      <b-field v-if="userIs('sv', conference.key)" class="is-vertical-center">
        <b-checkbox
          @input="onOnlyOwnTasksChange($event)"
          :value="onlyOwnTasks"
          :type="onlyOwnTasks ? 'is-danger' : 'is-primary'"
        >Only my tasks</b-checkbox>
      </b-field>

      <b-field expanded></b-field>

      <b-field position="is-right">
        <b-button @click="reload(true)" type="is-primary" icon-left="refresh">Reload</b-button>
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
      <template slot="top-left">
        <b-dropdown :value="columns" @input="setColumns($event)" multiple aria-role="list">
          <div slot="trigger" class="is-vertical-center is-clickable">
            <b-icon icon="dots-vertical"></b-icon>Columns
          </div>

          <b-dropdown-item
            v-if="canCreateTask || canDeleteTask"
            aria-role="listitem"
            value="manage"
          >Manage</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="date">Date</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="bid">Bid</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="start_at">Starts</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="end_at">Ends</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="hours">Hours</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="location">Location</b-dropdown-item>
          <b-dropdown-item aria-role="listitem" value="description">Description</b-dropdown-item>
          <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="slots">Slots</b-dropdown-item>
          <b-dropdown-item v-if="canCreateTask" aria-role="listitem" value="priority">Priority</b-dropdown-item>
        </b-dropdown>
      </template>
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
        <b-table-column width="1" :visible="columns.includes('bid')">
          <template slot="header">
            <div v-if="canBid">
              <task-bid-picker-radio
                :value="multiBidValue"
                @click-help="showBidAllHelp()"
                @input="onMultiBid"
                size="is-small"
                :show-help="true"
              ></task-bid-picker-radio>
            </div>
            <div v-else>Bid status</div>
          </template>
          <template>
            <task-bid-picker @error="fetchTasks()" size="is-small" v-model="props.row"></task-bid-picker>
          </template>
        </b-table-column>
        <b-table-column
          :visible="showDateColumn"
          field="tasks.date"
          sortable
          label="Date"
          :width="showDateColumn ? 93 : null"
        >
          {{ momentize(props.row.date,
          {format: 'l', fromToTz: timezoneName}) }}
        </b-table-column>
        <b-table-column
          :visible="columns.includes('start_at')"
          field="tasks.start_at"
          width="93"
          sortable
          label="Starts"
        >
          {{ momentize(
          props.row.start_at,
          {format: 'LT', fromToTz: timezoneName}
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
          {format: 'LT', fromToTz: timezoneName}
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
            <span class="is-marginless">No tasks found</span>

            <b v-if="search.length > 0">for {{ search }}</b>

            <span v-if="days.length > 0">
              on
              <div
                v-for="(day, index) in days"
                :key="index"
              >{{ momentize(day, {format:'ll', fromToTz: timezoneName}) }}</div>
            </span>

            <span v-if="interval[0] || interval[1]">
              between
              {{ interval[0] ? momentize(interval[0], {format: "LT"}) : "start of day" }}
              and
              {{ interval[1] ? momentize(interval[1], {format: "LT"}) : "end of day" }}
            </span>

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
import TasksImportModalVue from "@/components/modals/TasksImportModal.vue";
import JobModalVue from "@/components/modals/JobModal.vue";
import MultiBidConfirmModalVue from "@/components/modals/MultiBidConfirmModal.vue";
import { mapGetters, mapState, mapMutations, mapActions } from "vuex";

export default {
  props: ["conference"],

  data() {
    return {
      multiBidValue: null
    };
  },

  methods: {
    selectAllDays(type) {
      if (type == "conference") {
        this.setDays(this.conferenceDays.map(day => day.date));
      } else if ("tasks") {
        this.setDays(this.taskDays.map(day => day.date));
      }
      this.reload();
    },
    onMultiBid(preference) {
      if (this.totalTasks == 0 || this.onlyOwnTasks) {
        return;
      }
      if (this.warnBeforeMultiBid) {
        this.$buefy.modal.open({
          parent: this,
          component: MultiBidConfirmModalVue,
          hasModalCard: true,
          props: {
            preference,
            totalTasks: this.totalTasks,
            perPage: this.perPage,
            page: this.page,
            confirm: () => {
              this.createMultiBid(preference);
            }
          }
        });
      } else {
        this.createMultiBid(preference);
      }
    },
    createMultiBid(preference) {
      let onConfirm = () => {
        this.setIsLoading(true);
        var params = {
          conference_id: this.conference.id,
          preference
        };

        if (this.search) {
          params.search = this.search;
        }

        if (this.priorities && this.canChangePriorities) {
          params.priorities = this.priorities;
        }

        if (this.interval && (this.interval[0] || this.interval[1])) {
          params.interval = this.interval;
        }

        if (this.days && this.days.length > 0) {
          params.days = this.days.map(day => day.toMySqlDate());
        }

        api
          .createMultiBid(params)
          .then(({ data }) => {
            this.multiBidValue = preference;
            this.$buefy.notification.open({
              message: `${data.created} bids have been created<br>\
             ${data.updated} bids have been updated<br>\
             ${data.untouched} were already correct<br>\
             ${data.revoked} bids have been revoked`,
              type: "is-success",
              duration: 10000
            });
          })
          .catch(error => {
            this.$buefy.notification.open({
              message: error.response?.data?.message || error.message,
              duration: 5000,
              type: "is-danger"
            });
          })
          .finally(() => {
            this.setIsLoading(false);
            this.reload();
          });
      };

      const limit = 200;
      if (!this.warnBeforeMultiBid && this.totalTasks > limit) {
        this.$buefy.dialog.confirm({
          message: `You have more than ${limit} tasks selected.<br>\
                    Are you sure you want to continue?`,
          onConfirm
        });
      } else {
        onConfirm();
      }
    },
    reload(withDays = false) {
      this.fetchTasks();
      if (withDays) this.fetchTaskDays();
    },
    showBidAllHelp() {
      this.$buefy.dialog.confirm({
        title: "Multi-bid",
        message: `By clicking one of the preferences in the column's header you bid with the selected preference\
                  on all tasks which are currently in the table. This also includes any tasks on the next\
                  or previous page of the table (if any). You may filter for your desired tasks first.<br><br>More details are available in the FAQ entry.`,
        hasIcon: true,
        icon: "checkbox-multiple-marked",
        confirmText: "More info",
        cancelText: "Close",
        onConfirm: () => this.$router.push({ name: "faq", params: { id: 7 } })
      });
    },
    deleteAllTasks() {
      let days = this.days.map(day =>
        this.momentize(day, { format: "DD.MM.YYYY" })
      );
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message: `Are you sure you want to <b>delete all tasks for
         ${days.length > 1 ? "these days" : "this day"}
         (${days.join(", ")})</b>?\
         <br/>This will also delete associated assignments and bids for the tasks.\
         This action cannot be undone.`,
        confirmText: `Yes, delete all tasks of ${
          days.length > 1 ? "these days" : "this day"
        }`,
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          this.$buefy.dialog.confirm({
            title: "Really?",
            message: `Please confirm again that you want to <b>delete all tasks for\
            ${days.length > 1 ? "these days" : "this day"}
         (${days.join(", ")})</b>\
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
                  `days=${JSON.stringify(
                    this.days.map(day => day.toMySqlDate())
                  )}`
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
                  this.reload(true);
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
              date: this.conference.start_date,
              start_at: "09:00:00",
              end_at: "10:00:00",
              hours: 1,
              priority: 1,
              slots: 2,
              conference_id: this.conference.id
            },
            updated: () => {
              this.reload(true);
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
                  this.reload(true);
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
            this.reload(true);
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
        this.reload(true);
      });
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
    onPrioritiesChange(priorities) {
      this.setPriorities(priorities);
    },
    onOnlyOwnTasksChange(bool) {
      this.setOnlyOwnTasks(bool);
      this.reload();
    },
    onSearch(search) {
      this.setSearch(search);
      this.reload();
    },
    onDaysChange(days) {
      this.setDays(days);
      this.setPage(1);
      this.reload();
    },
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    },
    ...mapMutations("tasks", [
      "setColumns",
      "setSearch",
      "setDays",
      "setInterval",
      "setSortField",
      "setSortDirection",
      "setPerPage",
      "setPage",
      "setPriorities",
      "setOnlyOwnTasks",
      "setIsLoading"
    ]),
    ...mapActions("conference", ["fetchTaskDays"]),
    ...mapActions("tasks", ["fetchTasks"])
  },

  computed: {
    canChangePriorities() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key)
      );
    },
    timezoneName() {
      return this.conference.timezone.name;
    },
    canBid() {
      return (
        this.userIs("sv", this.conference.key, "accepted") &&
        this.conference.bidding_enabled &&
        this.dateFromMySql(this.conference.bidding_start) < new Date() &&
        this.dateFromMySql(this.conference.bidding_end) > new Date()
      );
    },
    canCreateTask() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key)
      );
    },
    canDeleteTask() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key)
      );
    },
    calendarEvents() {
      return [...this.conferenceDays, ...this.taskDays];
    },
    showDateColumn() {
      return (
        (this.days.length > 1 || this.days.length === 0) &&
        this.columns.includes("date")
      );
    },
    ...mapGetters("tasks", [
      "columns",
      "search",
      "days",
      "interval",
      "sortField",
      "sortDirection",
      "perPage",
      "page",
      "priorities",
      "onlyOwnTasks",
      "tasks",
      "totalTasks",
      "isLoading",
      "warnBeforeMultiBid"
    ]),
    ...mapGetters("conference", ["conferenceDays", "taskDays"]),
    ...mapGetters("auth", ["userIs"]),
    ...mapGetters("defines", { allPriorities: "priorities" })
  }
};
</script>
