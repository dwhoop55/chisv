<template>
  <div v-if="notes && notes.length > 0">
    <b-table
      :default-sort="['created_at', 'desc']"
      narrowed
      sortable
      :mobile-cards="false"
      :data="notes"
    >
      <template slot-scope="props">
        <b-table-column width="1">
          <b-icon
            class="is-clickable"
            icon="delete"
            type="is-danger"
            @click.native="deleteNote(props.row.id)"
          ></b-icon>
        </b-table-column>
        <b-table-column
          width="200"
          label="Created"
          field="created_at"
          sortable
        >{{ momentize(props.row.created_at, {format: 'l LT', fromTz: 'UTC', toTz: conference.timezone.name}) }}</b-table-column>
        <b-table-column width="200" label="Posted by">
          <span
            v-if="props.row.creator"
          >{{ props.row.creator.firstname }} {{ props.row.creator.lastname }}</span>
          <span v-else>N/A</span>
        </b-table-column>
        <b-table-column label="For" width="300" field="for_type" sortable>
          <span v-if="props.row.for_type === 'App\\User'">This user</span>
          <span v-else-if="props.row.for_type === 'App\\Assignment'">
            Assignment on
            <br />
            <b>{{props.row.for.task.name}}</b>
            <br />
            {{ momentize(props.row.for.task.date, {format:"l", fromToTz: conference.timezone.name}) }}
            {{ momentize(props.row.for.task.start_at, {format:"LT", fromToTz: conference.timezone.name}) }}
            – {{ momentize(props.row.for.task.end_at, {format:"LT", fromToTz: conference.timezone.name}) }}
          </span>
          <span v-else>Unknown</span>
        </b-table-column>
        <b-table-column label="Text" field="text" sortable>{{ props.row.text }}</b-table-column>
      </template>
    </b-table>
    <small
      class="has-text-weight-light"
    >Date and time are in conference time ({{ conference.timezone.name }})</small>
  </div>
  <div v-else>
    <p>No notes yet</p>
  </div>
</template>

<script>
export default {
  props: ["notes", "user", "conference"],

  data() {
    return {};
  }
};
</script>