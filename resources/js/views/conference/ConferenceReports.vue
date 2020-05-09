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
        <option value="sv_doubles">SV Doubles by name 😟</option>
        <option value="sv_accepted_minutes_ago">SVs accepted last X minutes</option>
        <option value="sv_demographics_country">SV Demographics (Country)</option>
        <option value="sv_demographics_language">SV Demographics (Language)</option>
        <option value="task_overview">Task Overview</option>
        <option value="tasks_free_slots">Tasks with free slots 😰</option>
        <option value="tasks_table_dump">Tasks table dump (for later import)</option>
      </b-select>

      <b-numberinput
        v-if="param('number') !== undefined"
        :value="param('number')"
        @input="onParamChange({key: 'number', value: $event})"
      />

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
        <b-field>
          <b-dropdown v-if="containsUsers" aria-role="list" @input="usersToNotify($event, true)">
            <button class="button is-primary" slot="trigger" slot-scope="{ active }">
              <span>Notify users..</span>
              <b-icon :icon="active ? 'menu-up' : 'menu-down'"></b-icon>
            </button>

            <b-dropdown-item
              :value="data"
              aria-role="listitem"
            >Use all {{ containsUsers }} users on Notify tab</b-dropdown-item>
            <b-dropdown-item
              :disabled="selectedRows.length == 0"
              :value="selectedRows"
              aria-role="listitem"
            >Use {{ selectedRows.length }} selected users on Notify tab</b-dropdown-item>
          </b-dropdown>
        </b-field>

        <b-field>
          <b-button
            :disabled="!selected || isLoading"
            @click="fetch()"
            type="is-primary"
            icon-left="refresh"
          >Reload</b-button>
        </b-field>
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
      :checkable="containsUsers > 0"
      :checked-rows.sync="selectedRows"
      hoverable
    >
      <b-input
        v-if="!props.column.numeric"
        slot="searchable"
        slot-scope="props"
        v-model="props.filters[props.column.field]"
        icon="magnify"
      />
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
    return {
      selectedRows: []
    };
  },

  created() {
    this.checkParamDisplay();
  },

  computed: {
    containsUsers() {
      if (!Array.isArray(this.data)) return;

      return this.data?.filter(
        item => item.user_id && item.firstname && item.lastname
      ).length;
    },
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
      "param",
      "updated",
      "selected",
      "paginated",
      "multiSort",
      "perPage",
      "page",
      "isLoading"
    ]),
    ...mapGetters("conference", ["tab"])
  },

  methods: {
    usersToNotify(source, changeTab = false) {
      if (changeTab) this.setTab(this.tab - 1);
      // Welcome to event passing hell!
      // We could also use vuex for this, but it's
      // actually more an event than a state
      var destinations = [];
      source
        .filter(item => item.user_id)
        .forEach(item => {
          if (Number.isInteger(item.user_id)) {
            // The row is a single user with a single user
            // id
            destinations.push({
              user_id: item.user_id,
              type: "user",
              display: `${item.firstname} ${item.lastname}`
            });
          } else if (Array.isArray(item.user_id)) {
            // The row has multiple user ids
            // Create an object for each of those id
            // with the same username
            item.user_id.forEach(id => {
              destinations.push({
                user_id: id,
                type: "user",
                display: `${item.firstname} ${item.lastname} (id: ${id})`
              });
            });
          }
        });
      this.$emit("update-notify-destinations", destinations);
    },
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
    fetch() {
      this.selectedRows = [];
      this.fetchReport(this.conference.key).finally(() => {
        if (this.$refs.table) {
          this.$refs.table.resetMultiSorting();
        }
      });
    },
    onParamChange(param) {
      this.setParam(param);
      this.fetch();
    },
    onSelectChange(selected) {
      this.setSelected(selected);
      this.checkParamDisplay();
      this.fetch();
    },
    onMultiSortChange(bool) {
      this.setMultiSort(bool);
      if (this.$refs.table) {
        this.$refs.table.resetMultiSorting();
      }
    },
    checkParamDisplay() {
      if (this.selected == "sv_accepted_minutes_ago") {
        this.setParam({ key: "number", value: 60 });
      } else {
        this.setParam({ key: "number", value: undefined });
      }
    },
    ...mapActions("reports", ["fetchReport"]),
    ...mapMutations("conference", ["setTab"]),
    ...mapMutations("reports", [
      "setParam",
      "setSelected",
      "setPaginated",
      "setPage",
      "setPerPage",
      "setMultiSort"
    ])
  }
};
</script>