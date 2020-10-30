<template>
  <div class="modal-card" style="height: 600px; width: 800; max-width: 100%">
    <header class="modal-card-head">
      <p class="modal-card-title">SVs View Settings</p>
    </header>
    <section class="modal-card-body">
      <b-field label="Visible columns">
        <b-taginput
          :value="activeColumns"
          :allow-new="false"
          :data="availableColumns"
          :open-on-focus="true"
          attached
          autocomplete
          field="display"
          @input="columnsChange($event)"
        >
        </b-taginput>
      </b-field>

      <b-field label="Limit SV states">
        <b-dropdown
          expanded
          @input="statesChange($event)"
          :value="states"
          multiple
          aria-role="list"
        >
          <button class="button" type="button" slot="trigger">
            <span v-if="states.length"
              >States ({{ states.length }}/{{ allStates.length }})</span
            >
            <span v-else>Limit by state</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

          <b-dropdown-item
            v-for="state in allStates"
            :key="state.id"
            :value="state.id"
            aria-role="listitem"
          >
            <span :class="stateType(state).replace('is-', 'has-text-')">{{
              state.name | capitalize
            }}</span>
          </b-dropdown-item>
        </b-dropdown>
      </b-field>

      <b-field label="SVs per page">
        <b-dropdown @change="perPageChange" :value="perPage" aria-role="list">
          <button class="button" slot="trigger">
            <span>{{ perPage }} per page</span>
            <b-icon icon="menu-down"></b-icon>
          </button>

          <b-dropdown-item value="5" aria-role="listitem"
            >5 per page
          </b-dropdown-item>
          <b-dropdown-item value="10" aria-role="listitem"
            >10 per page
          </b-dropdown-item>
          <b-dropdown-item value="20" aria-role="listitem"
            >20 per page
          </b-dropdown-item>
          <b-dropdown-item value="50" aria-role="listitem"
            >50 per page
          </b-dropdown-item>
        </b-dropdown>
      </b-field>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Close</b-button>
    </section>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
  name: "ConferenceSvsSettingsModal",
  props: ["conference"],
  data() {
    return {
      allColumns: [
        {
          display: "First name",
          name: "firstname",
          match: (v) => {
            console.log(v);
          },
        },
        { display: "Last name", name: "lastname" },
        { display: "University", name: "university" },
        { display: "SV State", name: "state" },
        { display: "Hours done", name: "hours", restricted: true },
        {
          display: "Lottery position",
          name: "lottery_position",
          restricted: true,
        },
        { display: "Enrolled", name: "enrolled_at", restricted: true },
        { display: "Form weight", name: "form_weight", restricted: true },
      ],
    };
  },

  created() {
    const unregisterRouterGuard = this.$router.beforeEach((to, from, next) => {
      this.$parent.close();
      next(false);
    });

    this.$once("hook:destroyed", () => {
      unregisterRouterGuard();
    });
  },
  computed: {
    allStates() {
      return this.statesFor("App\\User");
    },
    activeColumns() {
      return this.allColumns.filter((column) => {
        return this.columns.find((c) => c == column.name);
      });
    },
    availableColumns() {
      const liftsRestriction =
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key);

      return this.allColumns.filter((c) => {
        let exists = this.columns.find((column) => {
          return c.name == column;
        });
        return !exists && (!c.restricted || liftsRestriction);
      });
    },
    ...mapGetters("svs", ["columns", "states", "perPage"]),
    ...mapGetters("defines", ["statesFor"]),
  },

  methods: {
    perPageChange(perPage) {
      this.setPerPage(perPage);
    },
    statesChange(states) {
      this.setStates(states);
      this.fetchSvs(true);
    },
    columnsChange(columns) {
      this.setColumns(columns.map((c) => c.name));
    },
    ...mapMutations("svs", ["setColumns", "setStates", "setPerPage"]),
    ...mapGetters("auth", ["userIs"]),
    ...mapActions("svs", ["fetchSvs"]),
  },
};
</script>
