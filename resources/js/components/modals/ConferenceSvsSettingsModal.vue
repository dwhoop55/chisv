<template>
  <modal :show-footer="false" :show-close="true" @close="$emit('close')">
    <template v-slot:title> SVs View Settings </template>
    <template>
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
        <b-slider
          :max="100"
          :min="1"
          tooltip-always
          size="is-large"
          :type="sliderType"
          :value="perPage"
          lazy
          @input="perPageChange($event)"
        >
          <template v-for="val in [1, 25, 50, 75, 100]">
            <b-slider-tick :value="val" :key="val">{{ val }}</b-slider-tick>
          </template></b-slider
        >
      </b-field>

      <b-field label="UI Preferences">
        <b-field>
          <b-switch
            v-if="userIs('admin') || userIs('chair') || userIs('captain')"
            :value="showWaitlistPosition"
            @input="setShowWaitlistPosition"
          >
            Show waitlist position on SV state toggle
          </b-switch>
        </b-field>

        <b-field>
          <b-switch :value="showSvAvatar" @input="setShowSvAvatar">
            Show images for SVs
          </b-switch>
        </b-field>
      </b-field>
    </template>
  </modal>
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
    sliderType() {
      if (this.perPage >= 75) {
        return "is-danger";
      } else if (this.perPage >= 50) {
        return "is-warning";
      } else {
        return "is-success";
      }
    },
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
    ...mapGetters("svs", [
      "columns",
      "states",
      "perPage",
      "showWaitlistPosition",
      "showSvAvatar",
    ]),
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
      this.fetchSvs(true);
    },
    ...mapMutations("svs", [
      "setColumns",
      "setStates",
      "setPerPage",
      "setShowWaitlistPosition",
      "setShowSvAvatar",
    ]),
    ...mapGetters("auth", ["userIs"]),
    ...mapActions("svs", ["fetchSvs"]),
  },
};
</script>
