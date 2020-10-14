<template>
  <div>
    <b-loading :is-full-page="false" :active="isLoading"></b-loading>
    <b-button
      v-if="!wasLoaded && !isLoading"
      :disabled="isLoading"
      @click="getBids()"
      size="is-small"
      >{{ wasLoaded ? "Reload" : "Load" }}</b-button
    >
    <div v-if="bids && bids.length > 0">
      <b-table
        :default-sort="['task.date', 'desc']"
        :mobile-cards="false"
        narrowed
        sortable
        :data="bids"
      >
        <b-input
          v-if="!props.column.numeric"
          slot="searchable"
          slot-scope="props"
          v-model="props.filters[props.column.field]"
          placeholder="Search..."
        />
        <b-table-column
          width="120"
          field="task.date"
          label="Date"
          sortable
          searchable
          v-slot="props"
          >{{
            momentize(props.row.task.date, {
              format: "ll",
              fromToTz: conference.timezone.name,
            })
          }}</b-table-column
        >
        <b-table-column
          width="100"
          field="task.start_at"
          label="Start"
          sortable
          v-slot="props"
        >
          {{
            momentize(props.row.task.start_at, {
              format: "LT",
              fromToTz: conference.timezone.name,
            })
          }}
        </b-table-column>
        <b-table-column
          width="100"
          field="task.end_at"
          label="End"
          sortable
          v-slot="props"
        >
          {{
            momentize(props.row.task.end_at, {
              format: "LT",
              fromToTz: conference.timezone.name,
            })
          }}
        </b-table-column>
        <b-table-column
          width="40"
          field="task.hours"
          label="Hours"
          sortable
          v-slot="props"
          >{{
            hoursFromTime(timeFromDecimal(props.row.task.hours))
          }}</b-table-column
        >
        <b-table-column
          width="40"
          field="preference"
          label="Preference"
          sortable
          v-slot="props"
        >
          <b-tag rounded :type="preferenceType(props.row.preference)">{{
            preferenceString(props.row.preference)
          }}</b-tag>
        </b-table-column>
        <b-table-column
          searchable
          width="40"
          field="state.name"
          label="State"
          sortable
          v-slot="props"
        >
          <state-tag :state="props.row.state"></state-tag>
        </b-table-column>
        <b-table-column
          field="task.name"
          label="Task name"
          searchable
          sortable
          v-slot="props"
          >{{ props.row.task.name }}</b-table-column
        >
      </b-table>
    </div>
    <div v-else-if="wasLoaded">
      <p>No Bids yet</p>
    </div>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["user", "conference"],

  data() {
    return {
      bids: null,
      isLoading: false,
      wasLoaded: false,
    };
  },

  mounted() {
    this.getBids();
  },

  methods: {
    getBids() {
      this.isLoading = true;
      api
        .getUserBidsForConference(this.user.id, this.conference.key)
        .then(({ data }) => {
          this.bids = data;
          this.wasLoaded = true;
        })
        .finally(() => (this.isLoading = false));
    },
  },
};
</script>