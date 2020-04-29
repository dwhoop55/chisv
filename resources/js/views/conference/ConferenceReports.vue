<template>
  <div>
    <b-field grouped group-multiline>
      <b-select
        :disabled="isLoading"
        :value="selected"
        @input="onSelectChange($event)"
        placeholder="Select a report"
      >
        <option value="sv_shirts">SV T-Shirts</option>
        <option value="sv_hours">SV Hours</option>
        <option value="sv_bids">SV Bid</option>
        <option value="sv_detail">SV Detail 🧐</option>
        <option value="sv_demographics_country">SV Demographics (Country)</option>
        <option value="sv_demographics_language">SV Demographics (Language)</option>
        <option value="task_overview">Task Overview</option>
        <option value="tasks_free_slots">Tasks with free slots</option>
        <option value="tasks_table_dump">Tasks table dump (for later import)</option>
      </b-select>

      <b-field v-if="data" class="is-vertical-center">
        <b-dropdown :disabled="isLoading" @input="exportData($event)" aria-role="list">
          <button class="button is-primary" slot="trigger">
            <span>Export</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

          <b-dropdown-item value="model" aria-role="listitem">(All) Unsorted datamodel behind table</b-dropdown-item>
          <b-dropdown-item value="table" aria-role="listitem">(Only visible) sorted table content</b-dropdown-item>
        </b-dropdown>
      </b-field>

      <b-field v-if="isLoading" expanded>
        <b-progress
          v-if="isLoading"
          type="is-primary"
          size="is-large"
          show-value
        >This might take a long time</b-progress>
      </b-field>
      <b-field v-else expanded></b-field>

      <b-field position="is-right">
        <b-button
          :disabled="!selected || isLoading"
          @click="fetch(selected)"
          type="is-primary"
          icon-left="refresh"
        >Reload</b-button>
      </b-field>
    </b-field>

    <b-field v-if="data && columns" grouped>
      <b-field class="is-vertical-center">
        <b-switch :disabled="isLoading" @input="setPaginated($event)" :value="paginated">Paginated</b-switch>
        <b-switch
          :disabled="isLoading"
          @input="onMultiSortChange($event)"
          :value="multiSort"
        >Multi-column sort</b-switch>
      </b-field>
    </b-field>

    <span v-if="data">{{ data.length }} records &nbsp; | &nbsp;</span>
    <span v-if="updated">Last updated {{ momentize(updated, {fromNow: true}) }}</span>
    <p class="is-size-7">To scroll horizontal hold SHIFT while scrolling</p>

    <b-table
      style="overflow: auto"
      ref="table"
      :loading="isLoading"
      v-if="data && columns"
      :bordered="true"
      :narrowed="true"
      :data="data"
      :columns="columns"
      :paginated="paginated"
      :per-page="perPage"
      :current-page="page"
      :sort-multiple="multiSort"
      @page-change="setPage($event)"
      @per-page-change="setPerPage($event)"
      default-sort-direction="desc"
      :mobile-cards="false"
    >
      <template slot="footer">
        <div v-if="paginated" class="has-text-left">
          <b-dropdown @change="setPerPage($event)" :value="perPage" aria-role="list">
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
import ExportModalVue from "@/components/modals/ExportModal.vue";
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
  props: ["conference"],

  data() {
    return {};
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
    },
    ...mapGetters("reports", [
      "data",
      "columns",
      "updated",
      "selected",
      "paginated",
      "multiSort",
      "perPage",
      "page",
      "isLoading"
    ])
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
    fetch(name) {
      this.fetchReport(this.conference.key, name).finally(() => {
        if (this.$refs.table) {
          this.$refs.table.resetMultiSorting();
        }
      });
    },
    onSelectChange(selected) {
      this.setSelected(selected);
      this.fetch(selected);
    },
    onMultiSortChange(bool) {
      this.setMultiSort(bool);
      if (this.$refs.table) {
        this.$refs.table.resetMultiSorting();
      }
    },
    ...mapActions("reports", ["fetchReport"]),
    ...mapMutations("reports", [
      "setSelected",
      "setPaginated",
      "setPage",
      "setPerPage",
      "setMultiSort"
    ])
  }
};
</script>