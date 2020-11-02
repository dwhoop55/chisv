<template>
  <div>
    <b-field grouped group-multiline>
      <b-input
        v-debounce.fireonempty="searchChange"
        :value="search"
        placeholder="Search.."
        type="search"
        icon="magnify"
      ></b-input>

      <b-field>
        <button
          :disabled="isLoading"
          @click="
            fetchAcceptedCount();
            fetchSvs();
          "
          class="button is-grey"
        >
          <b-icon icon="refresh"></b-icon>
        </button>
      </b-field>

      <b-field>
        <button
          :disabled="isLoading"
          @click="openSettings()"
          class="button is-grey"
        >
          <b-icon icon="cog"></b-icon>
        </button>
      </b-field>

      <b-field
        v-if="canChangeFormWeights || canRunLottery || canUpdatePermission"
      >
        <b-dropdown :disabled="isLoading" aria-role="list">
          <button class="button" slot="trigger" slot-scope="{ active }">
            <span>Actions</span>
            <b-icon :icon="active ? 'menu-up' : 'menu-down'"></b-icon>
          </button>

          <b-dropdown-item
            v-if="canChangeFormWeights"
            aria-role="listitem"
            @click="showEnrollmentFormWeightsSettings()"
            >Adjust enrollment form weights
          </b-dropdown-item>
          <b-dropdown-item
            v-if="canRunLottery"
            aria-role="listitem"
            @click="runLottery()"
            >Run lottery to accept/waitlist SVs
          </b-dropdown-item>
          <b-dropdown-item
            v-if="canUpdatePermission"
            aria-role="listitem"
            @click="resetEnrolled()"
            >Reset <b>all</b> SVs to <i>enrolled</i>
          </b-dropdown-item>
        </b-dropdown>
      </b-field>
    </b-field>

    <b-table
      v-if="svs"
      :current-page="page"
      :data="svs"
      :default-sort="sortField"
      :default-sort-direction="sortDirection"
      :loading="isLoading"
      :mobile-cards="false"
      :per-page="perPage"
      narrowed
      paginated
      hoverable
      pagination-position="both"
      @sort="sortChange($event)"
      @page-change="pageChange($event)"
    >
      <b-table-column
        :visible="columns.includes('firstname')"
        cell-class="is-vertical-center-column"
        field="firstname"
        label="First name"
        sortable
        v-slot="props"
        width="50"
      >
        <div class="is-vertical-center">
          <figure v-if="showSvAvatar" class="media-left">
            <p class="image is-overflow-hidden is-64x64">
              <img :src="userAvatar(props.row)" />
            </p>
          </figure>
          <div class="media-content">
            <div class="content">
              <router-link
                v-if="userIsAdminOrChairOrCaptain(conference.key)"
                title="Go to the users profile"
                :to="{ name: 'user', params: { id: props.row.id } }"
                >{{ props.row.firstname }}</router-link
              >
              <div v-else>{{ props.row.firstname }}</div>
            </div>
          </div>
        </div>
      </b-table-column>

      <b-table-column
        :visible="columns.includes('lastname')"
        cell-class="is-vertical-center-column"
        field="lastname"
        label="Last name"
        sortable
        v-slot="props"
        width="40"
      >
        {{ props.row.lastname }}
      </b-table-column>

      <b-table-column
        :visible="columns.includes('university')"
        cell-class="is-vertical-center-column"
        width="80"
        field="university_name"
        label="University"
        v-slot="props"
        sortable
      >
        <p v-if="props.row.university_name">
          {{ props.row.university_name | textlimit(40) }}
        </p>
        <p v-else>N/A</p>
      </b-table-column>

      <b-table-column
        :visible="
          columns.includes('hours') &&
          userIsAdminOrChairOrCaptain(conference.key)
        "
        cell-class="is-vertical-center-column"
        field="hours_done"
        label="Hours"
        numeric
        sortable
        v-slot="props"
        width="10"
      >
        <span
          :class="{
            'has-text-danger has-text-weight-bold':
              props.row.hours_done >= conference.volunteer_hours,
          }"
          >{{ props.row.hours_done.toString().substr(0, 5) }}</span
        >
      </b-table-column>

      <b-table-column
        :visible="
          columns.includes('lottery_position') &&
          userIsAdminOrChairOrCaptain(conference.key)
        "
        cell-class="is-vertical-center-column"
        field="permission.lottery_position"
        label="Lottery pos"
        numeric
        sortable
        v-slot="props"
        width="1"
      >
        <div class="is-relative">
          <p v-if="props.row.permission.lottery_position != undefined">
            {{ props.row.permission.lottery_position }}
          </p>
          <b-tooltip
            v-else
            label="This user does not have a lottery position yet. Run the lottery to generate a random position"
          >
            <b-icon icon="help" size="is-small"></b-icon>
          </b-tooltip>
        </div>
      </b-table-column>

      <b-table-column
        :visible="
          columns.includes('form_weight') &&
          userIsAdminOrChairOrCaptain(conference.key)
        "
        cell-class="is-vertical-center-column"
        field="permission.enrollment_form.total_weight"
        label="Form Weight"
        numeric
        sortable
        v-slot="props"
        width="1"
      >
        <div class="is-relative">
          <p
            v-if="
              props.row.permission.enrollment_form &&
              props.row.permission.enrollment_form.total_weight != undefined
            "
          >
            {{ props.row.permission.enrollment_form.total_weight }}
          </p>
          <b-tooltip
            v-else
            label="This user does not have a an enrollment form weight yet. Adjust the form weight to generate this number"
          >
            <b-icon icon="help" size="is-small"></b-icon>
          </b-tooltip>
        </div>
      </b-table-column>

      <b-table-column
        :visible="
          columns.includes('enrolled_at') &&
          userIsAdminOrChairOrCaptain(conference.key)
        "
        cell-class="is-vertical-center-column"
        field="permission.created_at"
        label="Enrolled"
        sortable
        v-slot="props"
        width="10"
      >
        <b-tooltip
          type="is-light"
          :label="
            momentize(props.row.permission.created_at, {
              format: 'lll',
              fromTz: 'UTC',
            })
          "
          multilined
          >{{
            momentize(props.row.permission.created_at, {
              fromTz: "UTC",
              fromNow: true,
            })
          }}
        </b-tooltip>
      </b-table-column>

      <b-table-column
        :visible="columns.includes('state')"
        cell-class="is-vertical-center-column is-marginless is-paddingless"
        field="permission.state.id"
        label="SV State"
        sortable
        v-slot="props"
        width="1"
      >
        <b-dropdown
          v-if="
            canUpdatePermission &&
            props.row.permission &&
            props.row.permission.state
          "
          :disabled="isUpdatingState"
          :value="props.row.permission.state.id"
          aria-role="list"
          position="is-top-left"
          @change="updateSvState(props.row, $event)"
        >
          <button
            :class="
              'is-marginless button is-small ' +
              stateType(props.row.permission.state)
            "
            slot="trigger"
          >
            <span>{{
              props.row.permission.state.name +
              (showWaitlistPosition && props.row.permission.waitlist_position
                ? " (" + props.row.permission.waitlist_position.position + ")"
                : "")
            }}</span>
            <b-icon icon="menu-down"></b-icon>
          </button>
          <b-dropdown-item
            v-for="state in allStates"
            :key="state.id"
            :value="state"
            aria-role="listitem"
          >
            <p
              :class="
                'has-text-weight-bold ' +
                stateType(state).replace('is-', 'has-text-')
              "
            >
              {{ state.name }}
            </p>
          </b-dropdown-item>
        </b-dropdown>
        <state-tag
          v-else-if="props.row.permission && props.row.permission.state"
          :state="props.row.permission.state"
        />
      </b-table-column>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon v-if="isLoading" icon="emoticon" size="is-large"></b-icon>
              <b-icon v-else icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p
              v-if="
                search.length == 0 &&
                states &&
                allStates &&
                states.length == allStates.length &&
                !isLoading
              "
            >
              No users found.
            </p>
            <p v-else-if="isLoading">Loading..</p>
            <p v-else-if="search.length > 0">
              No users found for
              <b>{{ search }}</b>
              in {{ states.length }} SV States
            </p>
            <p v-else>No users found in {{ states.length }} SV States</p>
          </div>
        </section>
      </template>

      <template slot="bottom-left">
        <div class="is-block">
          <b-tag v-if="svs" type="is-light">
            Showing {{ svs.length }} SV{{ svs.length > 1 ? "s" : "" }}
          </b-tag>
          <b-tag v-if="canUpdatePermission" type="is-success">
            {{ conference.number_accepted_svs }}/{{ conference.volunteer_max }}
            SVs are accepted
          </b-tag>
        </div>
      </template>
    </b-table>
  </div>
</template>

<script>
import api from "@/api.js";
import Form from "vform";
import JobModalVue from "@/components/modals/JobModal.vue";
import EnrollmentFormSettingsModalVue from "@/components/modals/EnrollmentFormSettingsModal.vue";
import ConferenceSvsSettingsModalVue from "@/components/modals/ConferenceSvsSettingsModal.vue";
import { mapGetters, mapActions, mapMutations } from "vuex";

export default {
  name: "ConferenceSvs",
  props: ["conference"],

  data() {
    return {
      detailOpen: [],
      isUpdatingState: false,

      // This will ensure that the details won't open
      // on SV state dropdown click
      ignoreNextToggleClick: false,

      // We use this as a workaround to only 'v-if' the svBidsList
      // and the svNotificationsList
      // when the b-collapse is open
      // It will also close the bidList or notificationsList of other SVs
      // to make sure the DOM is kept small
      showBidsForUser: null,
      showNotificationsForUser: null,
    };
  },

  created() {
    this.fetchSvs(this.svs);
  },

  methods: {
    openSettings() {
      this.$buefy.modal.open({
        component: ConferenceSvsSettingsModalVue,
        parent: this,
        props: { conference: this.conference },
        hasModalCard: true,
      });
    },
    addNote(user) {
      this.$buefy.dialog.prompt({
        message: `Add note to ${user.firstname} ${user.lastname} for ${this.conference.key}`,
        inputAttrs: {},
        trapFocus: true,
        onConfirm: (text) => {
          api
            .createNote(user.id, `App\\User`, text, this.conference.id)
            .then(({ data }) => {
              this.$buefy.toast.open({
                message: data.message,
                type: "is-success",
              });
              this.fetchSvs();
            })
            .catch((error) => console.error(error));
        },
      });
    },
    combineNotes(user) {
      let assignmentNotes = [];
      user.assignments.forEach((a) => assignmentNotes.push(...a.notes));
      return [...user.notes, ...assignmentNotes];
    },
    showEnrollmentFormWeightsSettings() {
      this.$buefy.modal.open({
        parent: this,
        props: {
          value: this.parseEnrollmentForm(
            this.conference.enrollment_form_template
          ),
          update: (form) => {
            this.templateSettingsChanged(form);
          },
        },
        component: EnrollmentFormSettingsModalVue,
      });
    },
    resetEnrolled() {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message:
          "Are you sure you want to <b>reset all SVs to state enrolled?</b> This action cannot be undone.",
        confirmText: "Yes, reset all SVs",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          api
            .updateConferenceResetEnrollmentsToEnrolled(this.conference.key)
            .then(({ data }) => {
              this.$buefy.notification.open({
                duration: 5000,
                message: data.message,
                type: "is-success",
                hasIcon: true,
              });
            })
            .finally(() => {
              this.fetchSvs();
              this.fetchAcceptedCount();
            });
        }, // onConfirm
      });
    },
    runLottery() {
      api.runLottery(this.conference.key).then(({ data }) => {
        let jobId = data.result;
        this.$buefy.modal.open({
          parent: this,
          props: { id: jobId },
          component: JobModalVue,
          hasModalCard: true,
          onCancel: () => {
            this.fetchSvs();
            this.fetchAcceptedCount();
          },
        });
      });
    },
    templateSettingsChanged(newSettings) {
      var weights = {};

      for (var key in newSettings.meta) {
        if (
          newSettings.meta.hasOwnProperty(key) &&
          newSettings.meta[key].weight != undefined
        ) {
          weights[key] = newSettings.meta[key].weight;
        }
      }

      this.updateWeights(weights);
    },
    updateWeights(weights) {
      this.setIsLoading(true);
      api
        .updateConferenceEnrollmentFormWeights(this.conference.key, weights)
        .then(({ data }) => {
          this.$buefy.notification.open({
            duration: 5000,
            message: data.message,
            type: "is-success",
            hasIcon: true,
          });
          this.fetchSvs();
        })
        .finally(() => this.setIsLoading(false));
    },
    updateSvState(user, state) {
      var vform = new Form({
        state_id: state.id,
      });

      this.isUpdatingState = true;
      api
        .updatePermission(vform, user.permission.id)
        .then(({ data }) => {
          user.permission.state.name = state.name;
          user.permission.state.id = state.id;
          user.permission.state.description = state.description;
          user.permission.lottery_position = data.lottery_position;
          user.permission.waitlist_position = data.waitlist_position;
          this.fetchAcceptedCount();
        })
        .catch(() => this.fetchSvs())
        .finally(() => (this.isUpdatingState = false));
    },
    pageChange(page) {
      this.setPage(page);
    },
    perPageChange(perPage) {
      this.setPerPage(perPage);
    },
    sortChange(field, order) {
      this.setSortField(field);
      this.setSortDirection(order);
    },
    searchChange(search) {
      this.setSearch(search);
      this.fetchSvs();
    },
    isChairCaptainOrSelf(userId) {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.conference.key) ||
        this.userIs("captain", this.conference.key) ||
        this.user.id === userId
      );
    },
    ...mapActions("svs", ["fetchSvs"]),
    ...mapActions("conference", ["fetchAcceptedCount"]),
    ...mapMutations("svs", [
      "setSearch",
      "setSortField",
      "setSortDirection",
      "setPerPage",
      "setPage",
      "setStates",
      "setIsLoading",
      "setColumns",
    ]),
  },

  computed: {
    canChangeFormWeights() {
      return (
        (this.userIs("admin") || this.userIs("chair", this.conference.key)) &&
        this.enrollmentFormTemplate
      );
    },
    canRunLottery() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    canUpdatePermission() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    enrollmentFormTemplate() {
      return this.conference.enrollment_form_template;
    },
    allStates() {
      return this.statesFor("App\\User");
    },
    ...mapGetters("svs", [
      "svs",
      "search",
      "sortField",
      "sortDirection",
      "perPage",
      "page",
      "states",
      "isLoading",
      "showWaitlistPosition",
      "showSvAvatar",
      "columns",
    ]),
    ...mapGetters("defines", ["statesFor"]),
    ...mapGetters("auth", ["user", "userIs", "userIsAdminOrChairOrCaptain"]),
  },
};
</script>