<template>
  <div>
    <b-field grouped group-multiline>
      <b-input
        expanded
        @input="debounceGetUsers()"
        v-model="searchString"
        placeholder="Search anything..."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        class="control"
        @input="getUsers()"
        v-model="selectedStates"
        v-if="selectedStates && svStates"
        multiple
        aria-role="list"
      >
        <button class="button" type="button" slot="trigger">
          <span>SV states {{ selectedStates.length }} / {{ svStates.length }}</span>
          <b-icon icon="menu-down"></b-icon>
        </button>

        <b-dropdown-item
          v-for="state in svStates"
          :key="state.id"
          :value="state.id"
          aria-role="listitem"
        >
          <p
            :class="'has-text-weight-bold ' + stateType(state).replace('is-', 'has-text-')"
          >{{ state.name }}</p>
        </b-dropdown-item>
      </b-dropdown>

      <enrollment-form-settings-button
        v-if="enrollmentFormTemplate"
        class="control"
        @input="templateSettingsChanged()"
        v-model="enrollmentFormTemplate"
      ></enrollment-form-settings-button>

      <b-field v-if="canRunLottery">
        <b-button @click="runLottery()" type="is-warning">Run lottery & Accept</b-button>
      </b-field>

      <b-field v-if="canUpdateEnrollment">
        <b-button @click="resetEnrolled()" type="is-warning">
          Reset
          <b>all</b> SVs to 'enrolled'
        </b-button>
      </b-field>

      <div v-if="canUpdateEnrollment" style="align-items:center;">
        <b-taglist>
          <b-tag type="is-success" size="is-medium" rounded>
            {{ volunteers_count }} / {{ conference.volunteer_max }}
            SVs accepted
          </b-tag>
        </b-taglist>
      </div>
    </b-field>

    <br />
    <b-table
      ref="table"
      @click="toggle($event)"
      :data="users"
      detail-key="id"
      :show-detail-icon="true"
      detailed
      paginated
      backend-pagination
      :total="totalUsers"
      :per-page="perPage"
      @page-change="onPageChange"
      :loading="isLoading"
      :hoverable="true"
      backend-sorting
      default-sort="lastname"
      @sort="onSort"
      sort-icon="chevron-up"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
    >
      <template slot-scope="props">
        <b-table-column field="firstname" label="Firstname" sortable>
          <template>
            <div style="align-items:center;" class="is-flex">
              <figure class="media-left">
                <p class="image is-32x32">
                  <img :src="userAvatar(props.row)" />
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <a
                    v-if="canUpdateEnrollment"
                    title="Go to the users profile"
                    @click.native="ignoreNextToggleClick=true"
                    :href="'/user/' + props.row.id + '/edit'"
                  >{{ props.row.firstname }}</a>
                  <div v-else>{{ props.row.firstname }}</div>
                </div>
              </div>
            </div>
          </template>
        </b-table-column>
        <b-table-column field="lastname" label="Lastname" sortable>
          <template>{{ props.row.lastname }}</template>
        </b-table-column>
        <b-table-column width="300" field="university" label="University" sortable>
          <template>
            <p
              v-if="props.row.university"
              :title="props.row.university"
            >{{ props.row.university | textlimit(35) }}</p>
            <p v-else>N/A</p>
          </template>
        </b-table-column>
        <b-table-column v-if="props.row.email" width="130" field="email" label="E-Mail" sortable>
          <template>
            <a :href="'mailto:' + props.row.email">{{ props.row.email }}</a>
          </template>
        </b-table-column>
        <b-table-column width="130" label="SV State">
          <template>
            <b-dropdown
              ref="stateDropdown"
              v-if="canUpdateEnrollment"
              :value="props.row.permission.state.id"
              @change="updateSvState(props.row, $event)"
              @active-change="ignoreNextToggleClick=true"
              aria-role="list"
            >
              <button
                :class="'button is-small ' + stateType(props.row.permission.state)"
                slot="trigger"
              >
                <span>{{ props.row.permission.state.name + (props.row.permission.waitlist_position ? " ("+props.row.permission.waitlist_position.position+")" : "") }}</span>
                <b-icon icon="menu-down"></b-icon>
              </button>
              <b-dropdown-item
                v-for="state in svStates"
                :key="state.id"
                :value="state.id"
                aria-role="listitem"
              >
                <p
                  :class="'has-text-weight-bold ' + stateType(state).replace('is-', 'has-text-')"
                >{{ state.name }}</p>
              </b-dropdown-item>
            </b-dropdown>
            <state-tag v-else :state="props.row.permission.state" />
          </template>
        </b-table-column>
        <b-table-column
          v-if="props.row.permission.created_at"
          width="150"
          field="permission.created_at"
          label="Enrolled"
          sortable
        >
          <template>
            <b-tooltip
              type="is-light"
              :label="props.row.permission.created_at | moment('lll') "
              multilined
            >{{ $moment(props.row.permission.created_at).fromNow() }}</b-tooltip>
          </template>
        </b-table-column>
        <b-table-column
          field="permission.lottery_position"
          v-if="canUpdateEnrollment"
          width="150"
          label="Lottery position"
          sortable
        >
          <template>
            <div class="is-relative">
              <p
                v-if="props.row.permission.lottery_position != undefined"
              >{{ props.row.permission.lottery_position }}</p>
              <b-tooltip
                v-else
                label="This user does not have a lottery position yet. Run the lottery to generate a random position."
              >
                <b-icon icon="help" size="is-small"></b-icon>
              </b-tooltip>
            </div>
          </template>
        </b-table-column>
        <b-table-column
          field="permission.enrollment_form.total_weight"
          v-if="canUpdateEnrollment"
          width="150"
          label="Weighted form"
          sortable
        >
          <template>
            <div class="is-relative">
              <p
                v-if="props.row.permission.enrollment_form.total_weight != undefined"
              >{{ props.row.permission.enrollment_form.total_weight }}</p>
            </div>
          </template>
        </b-table-column>
      </template>

      <template slot="detail" slot-scope="props">
        <strong>{{ props.row.firstname }} {{ props.row.lastname }}</strong>

        <br />
        {{ props.row.city ? props.row.city + ", " : "" }}
        {{ props.row.region }}, {{ props.row.country }}
        <br />

        <div v-if="props.row.degree">
          Study Program:
          {{ props.row.degree }}
        </div>
        <div v-if="props.row.permission.enrollment_form">
          Enrollment form (Name: {{ props.row.permission.enrollment_form.name }}):
          <enrollment-form-summary
            class="section has-padding-t-8"
            v-model="props.row.permission.enrollment_form"
          ></enrollment-form-summary>
        </div>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon v-if="isLoading" icon="emoticon" size="is-large"></b-icon>
              <b-icon v-else icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p
              v-if="searchString.length == 0 && selectedStates.length == svStates.length && !isLoading"
            >No users found.</p>
            <p v-else-if="isLoading">Loading..</p>
            <p v-else-if="searchString.length > 0">
              No users found for
              <b>{{ searchString }}</b>
              in {{ selectedStates.length }} SV States
            </p>
            <p v-else>No users found in {{ selectedStates.length }} SV States</p>
          </div>
        </section>
      </template>

      <template slot="footer">
        <div class="has-text-right">
          <b-dropdown @change="perPage=$event;getUsers()" :value="perPage" aria-role="list">
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
import auth from "@/auth.js";
import Form from "vform";
import { filter } from "minimatch";
import debounce from "lodash/debounce";

export default {
  props: ["conference"],

  data() {
    return {
      users: [],
      totalUsers: 0,
      volunteers_count: 0,
      states: [],
      isLoading: true,
      searchString: "",
      selectedStates: [],
      sortField: "lastname",
      sortOrder: "asc",
      perPage: 20,
      page: 1,
      enrollmentFormTemplate: null,

      // This will ensure that the details won't open
      // on SV state dropdown click
      ignoreNextToggleClick: false,

      canUpdateEnrollment: false,
      canRunLottery: false
    };
  },

  created() {
    this.getCan();
    this.getEnrollmentFormTemplate();
    this.getStates(); // Also calls getUsers()
  },

  methods: {
    resetEnrolled() {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message:
          "Are you sure you want to <b>reset all SVs to state enrolled?</b> This action cannot be undone.",
        confirmText: "Yes, reset all SVs",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () =>
          api
            .updateConferenceResetEnrollmentsToEnrolled(this.conference.key)
            .then(data => {
              let total = data.data.result;
              if (total > 0) {
                this.$buefy.dialog.alert({
                  title: "SVs reset",
                  message: `${total} SVs have been reset to state 'enrolled'`,
                  type: "is-success",
                  hasIcon: true,
                  icon: "check-circle",
                  ariaRole: "alertdialog",
                  ariaModal: true
                });
              } else {
                this.$buefy.dialog.alert({
                  title: "No SVs reset",
                  message: `There are no SVs with a state different from 'enrolled'. No SV states have been modified.`,
                  type: "is-warning",
                  hasIcon: true,
                  icon: "alert-circle",
                  icon: "alert",
                  ariaRole: "alertdialog",
                  ariaModal: true
                });
              }
            })
            .catch(error => {
              this.$buefy.notification.open({
                duration: 5000,
                message: error.message,
                type: "is-danger",
                hasIcon: true
              });
            })
            .finally(() => {
              this.getUsers();
            })
      });
    },
    runLottery() {
      this.isLoading = true;

      api
        .runLottery(this.conference.key)
        .then(data => {
          let total = data.data.result;

          this.$buefy.dialog.alert({
            title: "Lottery ran",
            message: `'Enrolled' users processed: ${total.processed}<br/>
              Users newly accepted: ${total.accepted}<br/>
              Users new on waitlist: ${total.waitlisted}<br/>
              Users still waiting: ${total.still_waitlisted}`,
            type: "is-success",
            hasIcon: true,
            icon: "emoticon-cool-outline",
            ariaRole: "alertdialog",
            ariaModal: true
          });

          this.getUsers();
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
    },
    templateSettingsChanged() {
      var weights = {};

      for (var key in this.enrollmentFormTemplate.meta) {
        if (
          this.enrollmentFormTemplate.meta.hasOwnProperty(key) &&
          this.enrollmentFormTemplate.meta[key].weight != undefined
        ) {
          weights[key] = this.enrollmentFormTemplate.meta[key].weight;
        }
      }

      this.updateWeights(weights);
    },
    updateWeights(weights) {
      this.isLoading = true;
      api
        .updateConferenceEnrollmentFormWeights(this.conference.key, weights)
        .then(data => {
          this.$buefy.notification.open({
            duration: 5000,
            message: data.data.message,
            type: "is-success",
            hasIcon: true
          });
          this.getUsers();
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: error.message,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    getEnrollmentFormTemplate() {
      api
        .getEnrollmentFormTemplate(this.conference.enrollment_form_id)
        .then(data => {
          this.enrollmentFormTemplate = this.parseEnrollmentForm(data.data);
        })
        .catch(error => {
          this.enrollmentFormTemplate = null;
        });
    },
    updateSvState(user, $event) {
      var vform = new Form({
        id: user.permission.id,
        user_id: user.id,
        conference_id: user.permission.conference.id,
        role_id: user.permission.role.id,
        state_id: $event
      });

      this.isLoading = true;
      api
        .updatePermission(vform, user.permission.id)
        .then(response => {
          user.permission = response.data.result;
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: error.message,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    getStates: function() {
      api
        .getStates()
        .then(response => {
          this.states = response.data.data;
          this.svStates.forEach(state => {
            this.selectedStates.push(state.id);
          });
          this.getUsers();
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: error.message,
            type: "is-danger",
            hasIcon: true
          });
          reject();
        });
    },
    getCan: async function() {
      this.canUpdateEnrollment = await auth.can(
        "updateEnrollment",
        "Conference",
        this.conference.id
      );
      this.canRunLottery = await auth.can(
        "runLottery",
        "Conference",
        this.conference.id
      );
    },
    onPageChange(page) {
      this.page = page;
      this.getUsers();
    },
    onSort(field, order) {
      this.sortField = field;
      this.sortOrder = order;
      this.getUsers();
    },
    getUsers() {
      const params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortOrder}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `search_string=${this.searchString}`,
        `selected_states=${this.selectedStates}`
      ].join("&");

      this.isLoading = true;
      api
        .getConferenceSvs(this.conference.key, `?${params}`)
        .then(({ data }) => {
          this.users = data.data;
          this.totalUsers = data.total;
        })
        .catch(error => {
          this.data = [];
          this.total = 0;
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    debounceGetUsers: debounce(function() {
      this.getUsers();
    }, 250),
    toggle: function(row) {
      if (this.ignoreNextToggleClick) {
        this.ignoreNextToggleClick = false;
      } else {
        this.$refs.table.toggleDetails(row);
      }
    }
  },

  computed: {
    svStates: function() {
      return this.filterStates(this.states, "App\\User");
    }
  }
};
</script>