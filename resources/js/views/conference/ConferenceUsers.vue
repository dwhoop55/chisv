<template>
  <div>
    <b-field grouped group-multiline>
      <b-input
        expanded
        @input="onSearch($event)"
        v-model="searchString"
        placeholder="Search anything..."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        :disabled="isLoading"
        class="control"
        @active-change="($event == false) ? getUsers() : null"
        v-model="selectedStates"
        v-if="selectedStates && svStates"
        multiple
        aria-role="list"
      >
        <button class="button" type="button" slot="trigger">
          <span>SV states {{ selectedStates.length }}/{{ svStates.length }}</span>
          <b-icon icon="menu-down"></b-icon>
        </button>

        <b-dropdown-item
          :disabled="isLoading"
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
        :disabled="isLoading"
        v-if="enrollmentFormTemplate"
        class="control"
        @input="templateSettingsChanged()"
        v-model="enrollmentFormTemplate"
      ></enrollment-form-settings-button>

      <b-field v-if="canRunLottery">
        <b-button :disabled="isLoading" @click="runLottery()" type="is-primary">Run lottery & Accept</b-button>
      </b-field>

      <b-field v-if="canUpdateEnrollment">
        <b-button :disabled="isLoading" @click="resetEnrolled()" type="is-danger">
          Reset
          <b>all</b> SVs to 'enrolled'
        </b-button>
      </b-field>

      <div v-if="canUpdateEnrollment" style="align-items:center;">
        <b-taglist>
          <b-tag type="is-success" size="is-medium" rounded>
            {{ acceptedCount }}/{{ conference.volunteer_max }}
            SVs accepted
          </b-tag>
        </b-taglist>
      </div>

      <b-field expanded></b-field>

      <b-field position="is-right">
        <b-button @click="getUsers()" type="is-primary" icon-left="refresh">Reload</b-button>
      </b-field>
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
      :current-page="page"
      @page-change="onPageChange"
      @per-page-change="onPerPageChange"
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
            <div class="is-vertical-center">
              <figure class="media-left">
                <p class="image is-64x64">
                  <img :src="userAvatar(props.row)" />
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <a
                    v-if="canUpdateEnrollment"
                    title="Go to the users profile"
                    @click="ignoreNextToggleClick=true"
                    :href="'/user/' + props.row.id + '/edit'"
                  >{{ props.row.firstname }}</a>
                  <div v-else>{{ props.row.firstname }}</div>
                </div>
              </div>
            </div>
          </template>
        </b-table-column>
        <b-table-column
          class="is-vertical-center-column"
          field="lastname"
          label="Lastname"
          sortable
        >
          <template>{{ props.row.lastname }}</template>
        </b-table-column>
        <b-table-column
          class="is-vertical-center-column"
          width="400"
          field="universities.name"
          label="University"
          sortable
        >
          <template>
            <p
              v-if="props.row.university"
              :title="props.row.university"
            >{{ props.row.university | textlimit(45) }}</p>
            <p v-else>N/A</p>
          </template>
        </b-table-column>
        <b-table-column
          class="is-vertical-center-column"
          :visible="canRunLottery"
          width="130"
          field="email"
          label="E-Mail"
          sortable
        >
          <template>
            <a
              @click="ignoreNextToggleClick=true"
              :href="'mailto:' + props.row.email"
            >{{ props.row.email }}</a>
          </template>
        </b-table-column>
        <b-table-column
          class="is-vertical-center-column"
          :visible="canUpdateEnrollment"
          width="130"
          field="stats.hours_done"
          label="Hours done"
        >
          <template>
            <span
              v-if="props.row.stats"
              :class="{
                'has-text-danger has-text-weight-bold': props.row.stats.hours_done >= conference.volunteer_hours,
            }"
            >{{ props.row.stats.hours_done.toString().substr(0,5) }}</span>
          </template>
        </b-table-column>
        <b-table-column class="is-vertical-center-column" width="130" label="SV State">
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
          class="is-vertical-center-column"
          v-if="props.row.permission.created_at"
          width="150"
          field="created_at"
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
          class="is-vertical-center-column"
          field="lottery_position"
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
          class="is-vertical-center-column"
          field="enrollment_forms.total_weight"
          :visible="canUpdateEnrollment"
          width="150"
          label="Weighted form"
          sortable
        >
          <template>
            <div class="is-relative">
              <p
                v-if="props.row.permission &&
                 props.row.permission.enrollment_form &&
                  props.row.permission.enrollment_form.total_weight != undefined"
              >{{ props.row.permission.enrollment_form.total_weight }}</p>
            </div>
          </template>
        </b-table-column>
      </template>

      <template slot="detail" slot-scope="props">
        <div class="notification field is-floating-label">
          <label class="label">Person</label>
          Location:
          {{ props.row.city ? props.row.city + ", " : "" }}
          {{ props.row.region }}, {{ props.row.country }}
          <div v-if="props.row.degree">
            Study Program:
            {{ props.row.degree }}
          </div>
        </div>

        <b-field />

        <div v-if="props.row.assignments">
          <div class="notification field is-floating-label">
            <label class="label">Assigned Tasks</label>
            <sv-assignments-list v-model="props.row.assignments"></sv-assignments-list>
          </div>
        </div>

        <b-field />

        <div v-if="props.row.permission.enrollment_form">
          <div class="notification field is-floating-label">
            <label
              class="label"
            >Enrollment form (Type: {{ props.row.permission.enrollment_form.name }} )</label>
            <b-collapse :open="conference.state.name != 'running'" aria-id="contentIdForA11y1">
              <!-- This will hide the enrollment form when the conference is running to make the tasks better visible -->
              <a slot="trigger" slot-scope="props" aria-controls="contentIdForA11y1">
                <b-icon :icon="!props.open ? 'menu-down' : 'menu-up'"></b-icon>
                {{ !props.open ? 'Show' : 'Hide' }}
              </a>

              <enrollment-form-summary
                class="section has-padding-t-8"
                v-model="props.row.permission.enrollment_form"
              ></enrollment-form-summary>
            </b-collapse>
          </div>
        </div>

        <b-field />

        <div v-if="props.row.stats">
          <div class="notification field is-floating-label">
            <label class="label">Statistics</label>
            <small>
              Bids below are displayed in
              <small
                class="has-text-weight-light has-text-danger"
              >Unavailable</small>
              <small class="has-text-info">Low</small>
              <small class="has-text-warning">Medium</small>
              <small class="has-text-success">High</small>
              preference order
            </small>
            <div class="level">
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Hours done</p>
                  <div class="subtitle">
                    <small
                      :class="{
                'has-text-danger has-text-weight-bold': props.row.stats.hours_done >= conference.volunteer_hours,
            }"
                    >{{ props.row.stats.hours_done.toString().substr(0,5) }}/{{ conference.volunteer_hours }}</small>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Assignments done / total</p>
                  <div class="subtitle">
                    <small>{{ props.row.stats.assignments['done'] }} / {{ props.row.stats.assignments['count'] }}</small>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids placed</p>
                  <div class="subtitle">
                    <small class="has-text-danger">{{ props.row.stats.bids_placed['unavailable'] }}</small>
                    <small class="has-text-info">{{ props.row.stats.bids_placed['low'] }}</small>
                    <small class="has-text-warning">{{ props.row.stats.bids_placed['medium'] }}</small>
                    <small class="has-text-success">{{ props.row.stats.bids_placed['high'] }}</small>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids successful</p>
                  <div class="subtitle">
                    <small class="has-text-info">{{ props.row.stats.bids_successful['low'] }}</small>
                    <small class="has-text-warning">{{ props.row.stats.bids_successful['medium'] }}</small>
                    <small class="has-text-success">{{ props.row.stats.bids_successful['high'] }}</small>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids conflicting</p>
                  <div class="subtitle">
                    <small class="has-text-info">{{ props.row.stats.bids_conflict['low'] }}</small>
                    <small class="has-text-warning">{{ props.row.stats.bids_conflict['medium'] }}</small>
                    <small class="has-text-success">{{ props.row.stats.bids_conflict['high'] }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

      <template slot="bottom-left">
        <small
          class="has-text-weight-light"
        >Found {{ totalUsers }} SV{{ totalUsers > 1 ? 's' : '' }}</small>
      </template>
      <template slot="footer">
        <div class="has-text-right">
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
  </div>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";
import Form from "vform";
import { filter } from "minimatch";
import debounce from "lodash/debounce";
import JobModalVue from "@/components/modals/JobModal.vue";

export default {
  props: ["conference"],

  data() {
    return {
      users: [],
      totalUsers: 0,
      acceptedCount: 0,
      states: [],
      isLoading: true,
      searchString: this.$store.getters.svsSearch,
      selectedStates: [],
      sortField: "lastname",
      sortOrder: "asc",
      perPage: this.$store.getters.svsPerPage,
      page: this.$store.getters.svsPage,
      enrollmentFormTemplate: null,

      // This will ensure that the details won't open
      // on SV state dropdown click
      ignoreNextToggleClick: false,

      canUpdateEnrollment: false,
      canRunLottery: false,

      isCaptain: false
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
        onConfirm: () => {
          this.isLoading = true;
          api
            .updateConferenceResetEnrollmentsToEnrolled(this.conference.key)
            .then(data => {
              let jobId = data.data.result;
              this.$buefy.modal.open({
                parent: this,
                props: { id: jobId },
                component: JobModalVue,
                hasModalCard: true,
                onCancel: () => {
                  this.getUsers();
                }
              });
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
              this.getUsers();
            });
        } // onConfirm
      });
    },
    runLottery() {
      this.isLoading = true;
      api
        .runLottery(this.conference.key)
        .then(data => {
          let jobId = data.data.result;
          this.$buefy.modal.open({
            parent: this,
            props: { id: jobId },
            component: JobModalVue,
            hasModalCard: true,
            onCancel: () => {
              this.getUsers();
            }
          });
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
          this.getUsers();
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
        .getEnrollmentForm(this.conference.enrollment_form_id)
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
          this.getAcceptedCount();
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
    getAcceptedCount() {
      api
        .getConferenceAcceptedCount(this.conference.key)
        .then(data => {
          this.acceptedCount = data.data.result;
        })
        .catch(error => {
          this.acceptedCount = "error";
        });
    },
    onPageChange(page) {
      this.$store.commit("SVS_PAGE", page);
      this.page = page;
      this.getUsers();
    },
    onPerPageChange(perPage) {
      this.$store.commit("SVS_PER_PAGE", perPage);
      this.onPageChange(1);
      this.perPage = perPage;
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

      this.getAcceptedCount();

      this.isLoading = true;
      api
        .getConferenceSvs(this.conference.key, `?${params}`)
        .then(({ data }) => {
          this.users = data.data;
          this.totalUsers = data.total;
        })
        .catch(error => {
          this.users = [];
          this.totalUsers = 0;
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    onSearch(search) {
      this.onPageChange(1);
      this.debounceGetUsers(search);
    },
    debounceGetUsers: debounce(function() {
      this.getUsers();
      this.$store.commit("SVS_SEARCH", this.searchString);
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