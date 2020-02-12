<template>
  <div>
    <b-field grouped group-multiline>
      <b-select v-model="selected" @input="load($event)" placeholder="Select a report" required>
        <option value="shirt">T-Shirt</option>
        <option value="sv_hours">SV hours</option>
      </b-select>

      <b-field class="is-vertical-center">
        <b-button :disabled="!data || !columns" type="is-primary" icon-left="database-export">
          <download-csv :data="data">Export Unsorted Data model</download-csv>
        </b-button>
      </b-field>

      <b-field class="is-vertical-center">
        <b-button :disabled="!data || !columns" type="is-primary" icon-left="database-export">
          <download-csv :data="$refs.table.visibleData">Export Table below with pagination</download-csv>
        </b-button>
      </b-field>

      <b-field class="is-vertical-center">
        <b-switch @input="$store.commit('REPORT_PAGINATED', $event)" v-model="isPaginated">Paginated</b-switch>
      </b-field>

      <b-field expanded></b-field>

      <b-field position="is-right">
        <b-button
          :disabled="!selected"
          @click="load(selected)"
          type="is-primary"
          icon-left="refresh"
        >Reload</b-button>
      </b-field>
    </b-field>

    <p>Last updated {{ updated | moment("from") }}</p>

    <b-table
      v-if="data && columns"
      :bordered="true"
      :hoverable="true"
      :narrowed="true"
      :data="data"
      :columns="columns"
      :paginated="isPaginated"
      :per-page="10"
      ref="table"
    ></b-table>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </div>
</template>

<script>
import api from "@/api.js";
import moment from "moment-timezone";

export default {
  props: ["conference"],

  data() {
    return {
      data: this.$store.getters.reportData,
      columns: this.$store.getters.reportColumns,
      updated: this.$store.getters.reportUpdated,
      selected: this.$store.getters.reportSelected,
      isPaginated: this.$store.getters.reportPaginated,
      isLoading: false
    };
  },

  methods: {
    load(name) {
      this.isLoading = true;
      api
        .getReport(this.conference.key, name)
        .then(data => {
          this.data = data.data.data;
          this.columns = data.data.columns;
          this.updated = data.data.updated;
          this.$store.commit("REPORT_DATA", data.data.data);
          this.$store.commit("REPORT_COLUMNS", data.data.columns);
          this.$store.commit("REPORT_UPDATED", data.data.updated);
          this.$store.commit("REPORT_SELECTED", this.selected);
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
    }
  },

  csvExport() {
    if (!data || !columns) {
      return;
    }
  }
};
</script>