<template>
  <div>
    <b-field grouped group-multiline>
      <b-select v-model="selected" @input="load($event)" placeholder="Select a report">
        <option value="shirts">T-Shirts</option>
        <option value="svs">SVs</option>
        <option value="task_overview">Task Overview</option>
        <option value="tasks_free_slots">Tasks with free slots</option>
      </b-select>

      <b-field v-if="data" class="is-vertical-center">
        <b-dropdown @input="exportData($event)" aria-role="list">
          <button class="button is-primary" slot="trigger">
            <span>Export</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

          <b-dropdown-item value="model" aria-role="listitem">Unsorted datamodel behind table</b-dropdown-item>
          <b-dropdown-item value="table" aria-role="listitem">Visible sorted table content</b-dropdown-item>
        </b-dropdown>
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

    <b-field v-if="data && columns" grouped>
      <b-field class="is-vertical-center">
        <b-switch @input="$store.commit('REPORT_PAGINATED', $event)" v-model="isPaginated">Paginated</b-switch>
      </b-field>
    </b-field>

    <span v-if="data">{{ data.length }} records &nbsp; | &nbsp;</span>
    <span v-if="updated">Last updated {{ updated | moment("from") }}</span>

    <b-table
      v-if="data && columns"
      :bordered="true"
      :narrowed="true"
      :data="data"
      :columns="columns"
      :paginated="isPaginated"
      :per-page="perPage"
      :current-page="page"
      @page-change="onPageChange"
      @per-page-change="onPerPageChange"
      default-sort-direction="desc"
      :mobile-cards="false"
      ref="table"
    >
      <template slot="footer">
        <div v-if="isPaginated" class="has-text-right">
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
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </div>
</template>

<script>
import api from "@/api.js";
import moment from "moment-timezone";
import ExportModalVue from "@/components/modals/ExportModal.vue";

export default {
  props: ["conference"],

  data() {
    return {
      data: this.$store.getters.reportData,
      columns: this.$store.getters.reportColumns,
      updated: this.$store.getters.reportUpdated,
      selected: this.$store.getters.reportSelected,
      isPaginated: this.$store.getters.reportPaginated,
      perPage: this.$store.getters.reportPerPage,
      page: this.$store.getters.reportPage,
      isLoading: false
    };
  },

  computed: {
    tableData() {
      if (
        this.data &&
        this.$refs &&
        this.$refs.table &&
        this.$refs.table.visibleData
      ) {
        return this.$refs.table.visibleData;
      } else {
        return null;
      }
    }
  },

  methods: {
    exportData(type) {
      var data = null;
      switch (type) {
        case "table":
          data = this.tableData;
          break;
        default:
          data = this.data;
          break;
      }
      this.$buefy.modal.open({
        parent: this,
        component: ExportModalVue,
        hasModalCard: true,
        props: { data: data, suggestedName: this.selected },
        trapFocus: true
      });
    },
    load(name) {
      this.isLoading = true;
      api
        .getReport(this.conference.key, name)
        .then(data => {
          this.isPaginated = data.data.paginate;
          this.data = data.data.data;
          this.columns = data.data.columns;
          this.updated = data.data.updated;
          this.$store.commit("REPORT_PAGINATED", data.data.paginate);
          this.$store.commit("REPORT_DATA", data.data.data);
          this.$store.commit("REPORT_COLUMNS", data.data.columns);
          this.$store.commit("REPORT_UPDATED", data.data.updated);
          this.$store.commit("REPORT_SELECTED", this.selected);
        })
        .catch(error => {
          var message = error.response.data
            ? error.response.data.message
            : error.message;
          this.$buefy.notification.open({
            duration: 5000,
            message: message,
            type: "is-danger",
            hasIcon: true
          });
          this.data = null;
          this.columns = null;
          this.updated = null;
          this.$store.commit("REPORT_DATA", null);
          this.$store.commit("REPORT_COLUMNS", null);
          this.$store.commit("REPORT_UPDATED", null);
          this.$store.commit("REPORT_SELECTED", this.selected);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    onPageChange(page) {
      this.$store.commit("REPORT_PAGE", page);
      this.page = page;
    },
    onPerPageChange(perPage) {
      this.$store.commit("REPORT_PER_PAGE", perPage);
      this.onPageChange(1);
      this.perPage = perPage;
    }
  }
};
</script>