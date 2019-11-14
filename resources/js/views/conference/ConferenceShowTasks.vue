<template>
  <div>
    <b-field grouped group-multiline>
      <b-input
        expanded
        @input="debounceGetTasks()"
        v-model="searchString"
        placeholder="Search anything..."
        type="search"
        icon="magnify"
      ></b-input>

      <b-datepicker @input="getTasks()" v-model="day" :events="conferenceDays" indicators="bars">
        <template slot="header">
          <b-tag type="is-info">Conference days</b-tag>
        </template>
      </b-datepicker>

      <b-dropdown
        :disabled="isLoading"
        class="control"
        @active-change="($event == false) ? getTasks() : null"
        v-model="selectedPriorities"
        v-if="selectedPriorities"
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
    </b-field>

    <br />

    <b-table :data="tasks" narrowed hoverable :loading="isLoading">
      <template slot-scope="props">
        <!-- <b-table-column field="id" label="ID" width="40" numeric>{{ props.row.id }}</b-table-column> -->

        <b-table-column field="task.name" label="Name" sortable>{{ props.row.name }}</b-table-column>
        <b-table-column field="task.location" label="Location">{{ props.row.location }}</b-table-column>
        <b-table-column field="task.priority" label="Priority">{{ props.row.priority }}</b-table-column>
        <b-table-column field="task.slots" label="Available slots">{{ props.row.slots }}</b-table-column>
        <b-table-column field="task.hours" label="Hours">{{ props.row.hours }}</b-table-column>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p>No tasks found.</p>
          </div>
        </section>
      </template>
    </b-table>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["conference"],

  data() {
    return {
      tasks: [],
      searchString: "",
      day: new Date(this.conference.start_date),
      selectedPriorities: [1, 2, 3],
      allPriorities: [1, 2, 3],
      sortField: "name",
      sortOrder: "asc",
      perPage: 10,
      page: 1,
      isLoading: true
    };
  },

  methods: {
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
    debounceGetTasks: debounce(function() {
      this.getTasks();
    }, 250)
  },

  created() {
    this.getTasks();
  },

  computed: {
    conferenceDays() {
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
          type: "is-info"
        });
      }
      return days;
    }
  }
};
</script>
