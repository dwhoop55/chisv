<template>
  <div>
    <b-field grouped group-multiline>
      <b-datepicker
        :date-formatter="dateFormatter"
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
        @input="debounceGetAssignments()"
        v-model="searchString"
        placeholder="Search.."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        :value="activeColumns"
        @input="$store.commit('ASSIGNMENTS_COLUMNS', $event)"
        multiple
        aria-role="list"
      >
        <button class="button is-primary" slot="trigger">
          <span>Visible columns</span>
          <b-icon icon="menu-down"></b-icon>
        </button>

        <b-dropdown-item aria-role="listitem" value="location">Location</b-dropdown-item>
        <b-dropdown-item aria-role="listitem" value="description">Description</b-dropdown-item>
      </b-dropdown>
    </b-field>
    <br />

    <b-table
      @page-change="onPageChange"
      @sort="onSort"
      ref="table"
      :data="assigmnents"
      paginated
      backend-pagination
      :total="totalAssignments"
      :per-page="perPage"
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
              No assignments found for
              <b v-if="searchString.length > 0">{{ searchString }}</b>
              {{ day | moment('ll') }}
            </p>
          </div>
        </section>
      </template>

      <template slot="bottom-left">
        <small
          class="has-text-weight-light"
        >{{ totalAssignmnents > 0 ? totalAssignmnents : 'No' }} {{ totalAssignmnents == 1 ? 'assignment' : 'assignmnents' }} for {{ this.day | moment('ll') }}</small>
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

export default {
  props: ["conference"],

  data() {
    return {
      assignments: [],
      taskDays: [],
      totalAssignments: null,
      searchString: this.$store.getters.tasksSearch,
      day: new Date(this.$store.getters.tasksDay),
      sortField: this.$store.getters.tasksSortField,
      sortDirection: this.$store.getters.tasksSortDirection,
      perPage: this.$store.getters.tasksPerPage,
      page: this.$store.getters.tasksPage,

      isLoading: true,
      isLoadingCalendar: true,

      ignoreNextToggleClick: false
    };
  },

  methods: {
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
    getAssignments() {
      this.$store.commit("ASSIGNMENTS_DAY", this.day);

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
          this.assignments = data.data;
          this.totalAssignments = data.total;
        })
        .catch(error => {
          this.assignments = [];
          this.totalAssignments = 0;
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    onPageChange(page) {
      this.$store.commit("ASSIGNMENTS_PAGE", page);
      this.page = page;
      this.getAssignments();
    },
    onPerPageChange(perPage) {
      this.$store.commit("ASSIGNMENTS_PER_PAGE", perPage);
      this.perPage = perPage;
      this.getAssignments();
    },
    onSort(field, direction) {
      this.sortField = field;
      this.sortDirection = direction;
      this.$store.commit("ASSIGNMENTS_SORT_FIELD", field);
      this.$store.commit("ASSIGNMENTS_SORT_DIRECTION", direction);
      this.getAssignments();
    },
    onDayChange() {
      this.onPageChange(1);
    },
    debounceGetTasks: debounce(function() {
      this.$store.commit("ASSIGNMENTS_SEARCH", this.searchString);
      this.getAssignments();
    }, 250),
    showDescription(task) {
      this.$buefy.dialog.alert({
        title: task.name,
        message: task.description
      });
    }
  },

  created() {
    this.getAssignments();
    this.getTaskDays();
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
