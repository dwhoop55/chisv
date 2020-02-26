<template>
  <div v-if="assignments && assignments.length > 0">
    <b-table
      :default-sort="['task.date', 'desc']"
      narrowed
      sortable
      :mobile-cards="false"
      :data="assignments"
    >
      <template slot-scope="props">
        <b-table-column field="state.name" label="State" sortable>
          <div v-if="props.row.state.name == 'assigned'">
            <b-icon type="is-warning" icon="account" />
            <span>&nbsp;Scheduled</span>
          </div>

          <div v-if="props.row.state.name == 'checked-in'">
            <b-icon type="is-warning" icon="account-clock" />
            <span>&nbsp;Checked-in</span>
          </div>

          <div v-if="props.row.state.name == 'done'">
            <b-icon type="is-success" icon="account-heart" />
            <span>&nbsp;Done</span>
          </div>
        </b-table-column>
        <b-table-column field="task.name" label="Task name" sortable>{{ props.row.task.name }}</b-table-column>
        <b-table-column
          field="task.date"
          label="Date"
          sortable
        >{{ props.row.task.date | moment('ll') }}</b-table-column>
        <b-table-column
          field="task.start_at"
          label="Start"
          sortable
        >{{ hoursFromTime(props.row.task.start_at) }}</b-table-column>
        <b-table-column
          field="task.end_at"
          label="End"
          sortable
        >{{ hoursFromTime(props.row.task.end_at) }}</b-table-column>
        <b-table-column
          field="task.location"
          label="Location"
          sortable
        >{{ props.row.task.location | textlimit(40) }}</b-table-column>
        <b-table-column
          field="hours"
          label="Accounted hours"
          sortable
        >{{ hoursFromTime(timeFromDecimal(props.row.hours)) }}</b-table-column>
      </template>
    </b-table>
  </div>
  <div v-else>
    <p>No assignments yet</p>
  </div>
</template>

<script>
export default {
  props: ["assignments"],
  model: {
    prop: "assignments"
  },
  data() {
    return {};
  }
};
</script>