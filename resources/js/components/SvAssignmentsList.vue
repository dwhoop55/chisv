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
        <b-table-column class="is-flex" field="state.name" label="State" sortable width="180">
          <b-icon
            v-if="canViewNotes && props.row.notes.length"
            class="is-clickable"
            @click.native="showNotes(props.row.notes)"
            icon="message-alert-outline"
          ></b-icon>
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
          width="120"
        >{{ momentize(props.row.task.date, {format:'ll', fromToTz: conference.timezone.name}) }}</b-table-column>
        <b-table-column field="task.start_at" label="Start" sortable width="93">
          {{ momentize(
          props.row.task.start_at,
          {format:'LT', fromToTz: conference.timezone.name}
          ) }}
        </b-table-column>
        <b-table-column field="task.end_at" label="End" sortable width="93">
          {{ momentize(
          props.row.task.end_at,
          {format: 'LT', fromToTz: conference.timezone.name}
          ) }}
        </b-table-column>
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
import { mapGetters } from "vuex";
export default {
  name: "SvAssignmentsList",
  props: ["assignments", "conference", "canViewNotes"]
};
</script>