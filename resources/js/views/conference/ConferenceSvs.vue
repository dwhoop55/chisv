<template>
  <div>
    <b-field grouped group-multiline>
      <b-input
        expanded
        v-debounce.fireonempty="onSearch"
        :value="search"
        placeholder="Search.."
        type="search"
        icon="magnify"
      ></b-input>

      <b-field>
        <state-picker
          :hide-description="true"
          :multiple="true"
          forType="User"
          :value="states"
          @change="onStatesChange($event)"
          @active-change="($event == false) ? fetchSvs() : null"
          text="Filter by state"
        ></state-picker>
      </b-field>

      <b-field>
        <b-button
          type="is-primary"
          :disabled="isLoading"
          v-if="(userIs('admin') || userIs('chair', conference.key)) && enrollmentFormTemplate"
          @click="showEnrollmentFormWeightsSettings"
        >Form Weights</b-button>
      </b-field>

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
        <b-button
          @click="fetchAcceptedCount();fetchSvs()"
          type="is-primary"
          icon-left="refresh"
        >Reload</b-button>
      </b-field>
    </b-field>

    <br />
    <b-table
      ref="table"
      v-if="data.data"
      :data="data.data"
      @click="toggle($event)"
      detail-key="id"
      :opened-detailed="detailOpen"
      :show-detail-icon="true"
      detailed
      paginated
      pagination-position="both"
      backend-pagination
      :total="data.total"
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
                    @click="ignoreNextToggleClick=true"
                    :to="{name: 'user', params: {id: props.row.id}}"
                  >{{ props.row.firstname }}</router-link>
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
            >{{ props.row.university | textlimit(40) }}</p>
            <p v-else>N/A</p>
          </template>
        </b-table-column>
        <b-table-column
          class="is-vertical-center-column"
          :visible="userIsAdminOrChairOrCaptain(conference.key)"
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
            <div class="is-relative">
              <transition name="fade">
                <b-dropdown
                  ref="stateDropdown"
                  v-if="canUpdateEnrollment && props.row.permission && props.row.permission.state"
                  :value="props.row.permission.state.id"
                  @change="updateSvState(props.row, $event)"
                  @active-change="ignoreNextToggleClick=true"
                  aria-role="list"
                >
                  <button
                    :class="'button is-small ' + stateType(props.row.permission.state)"
                    slot="trigger"
                  >
                    <span>{{ props.row.permission.state.name + ( showWaitlistPosition && props.row.permission.waitlist_position ? " ("+props.row.permission.waitlist_position.position+")" : "") }}</span>
                    <b-icon icon="menu-down"></b-icon>
                  </button>
                  <b-dropdown-item
                    v-for="state in allStates"
                    :key="state.id"
                    :value="state.id"
                    aria-role="listitem"
                  >
                    <p
                      :class="'has-text-weight-bold ' + stateType(state).replace('is-', 'has-text-')"
                    >{{ state.name }}</p>
                  </b-dropdown-item>
                </b-dropdown>
                <state-tag
                  v-else-if="props.row.permission && props.row.permission.state"
                  :state="props.row.permission.state"
                />
              </transition>
              <b-loading :is-full-page="false" :active="isUpdatingState"></b-loading>
            </div>
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
              :label="formatTime(props.row.permission.created_at, 'lll', {toTz:true}) "
              multilined
            >{{ formatTime(props.row.permission.created_at, null, {fromNow: true}) }}</b-tooltip>
          </template>
        </b-table-column>
        <b-table-column
          class="is-vertical-center-column"
          field="lottery_position"
          v-if="userIsAdminOrChairOrCaptain(conference.key)"
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
          :visible="userIsAdminOrChairOrCaptain(conference.key)"
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
          {{ props.row.region ? props.row.region + ", " : '' }}
          {{ props.row.country ? props.row.country : '' }}
          <div v-if="props.row.degree">
            Study Program:
            {{ props.row.degree }}
          </div>

          <div v-if="props.row.email">
            E-Mail:
            <a
              @click="ignoreNextToggleClick=true"
              :href="'mailto:' + props.row.email"
            >{{ props.row.email }}</a>
          </div>

          <div v-if="props.row.past_conferences && props.row.past_conferences.length > 0">
            Attended conferences:
            <b-taglist>
              <b-tag
                type="is-light"
                v-for="(conference, index) in props.row.past_conferences"
                :key="index"
              >{{ conference }}</b-tag>
            </b-taglist>
          </div>
          <div
            v-else-if="props.row.past_conferences && props.row.past_conferences.length == 0"
          >Did not attend conferences yet</div>

          <div v-if="props.row.past_conferences_sv && props.row.past_conferences_sv.length > 0">
            Attended conferences as SV:
            <b-taglist>
              <b-tag
                type="is-light"
                v-for="(conference, index) in props.row.past_conferences_sv"
                :key="index"
              >{{ conference }}</b-tag>
            </b-taglist>
          </div>
          <div
            v-else-if="props.row.past_conferences_sv && props.row.past_conferences_sv.length == 0"
          >Did not attend conferences as SV yet</div>

          <div v-if="props.row.languages && props.row.languages.length > 0">
            Spoken languages:
            <b-taglist>
              <b-tag
                type="is-light"
                v-for="(language, index) in props.row.languages"
                :key="index"
              >{{ language.name }}</b-tag>
            </b-taglist>
          </div>
          <div
            v-else-if="props.row.languages && props.row.languages.length == 0"
          >No spoken languages known</div>
        </div>

        <b-field />

        <div v-if="props.row.assignments">
          <div class="notification field is-floating-label">
            <label class="label">Assigned Tasks</label>
            <sv-assignments-list :assignments="props.row.assignments" :conference="conference"></sv-assignments-list>
          </div>
        </div>

        <b-field />

        <div v-if="props.row.canViewBids">
          <div class="notification field is-floating-label">
            <label class="label">Bids</label>
            {{ props.open }}
            <b-collapse
              @open="showBidsForUser=props.row.id"
              @close="showBidsForUser=null"
              :open="showBidsForUser == props.row.id"
            >
              <span slot="trigger" slot-scope="props">
                <b-icon :icon="!props.open ? 'menu-down' : 'menu-up'"></b-icon>
                {{ !props.open ? 'Show' : 'Hide' }}
              </span>
              <sv-bids-list
                v-if="showBidsForUser == props.row.id"
                :user="props.row"
                :conference="conference"
              ></sv-bids-list>
            </b-collapse>
          </div>
        </div>

        <b-field />

        <div v-if="props.row.permission.enrollment_form">
          <div class="notification field is-floating-label">
            <label
              class="label"
            >Enrollment form (Type: {{ props.row.permission.enrollment_form.name }} )</label>
            <b-collapse :open="conference.state.name != 'running'">
              <!-- This will hide the enrollment form when the conference is running to make the tasks better visible -->
              <span slot="trigger" slot-scope="props">
                <b-icon :icon="!props.open ? 'menu-down' : 'menu-up'"></b-icon>
                {{ !props.open ? 'Show' : 'Hide' }}
              </span>

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
            <div class="level">
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Hours done</p>
                  <div class="subtitle">
                    <span
                      :class="{
                'has-text-danger has-text-weight-bold': props.row.stats.hours_done >= conference.volunteer_hours,
            }"
                    >{{ props.row.stats.hours_done.toString().substr(0,5) }}/{{ conference.volunteer_hours }}</span>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Assignments done</p>
                  <div class="subtitle">
                    <span>{{ props.row.stats.assignments['done'] }} / {{ props.row.stats.assignments['count'] }}</span>
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids placed</p>
                  <div class="subtitle">
                    <bid-counter :bids="props.row.stats.bids_placed" />
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids successful</p>
                  <div class="subtitle">
                    <bid-counter :bids="props.row.stats.bids_successful" />
                  </div>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">Bids conflicting</p>
                  <div class="subtitle">
                    <bid-counter :bids="props.row.stats.bids_successful" />
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
              v-if="search.length == 0 && states && allStates && states.length == allStates.length && !isLoading"
            >No users found.</p>
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
        <small
          class="has-text-weight-light"
        >Found {{ data.total }} SV{{ data.total > 1 ? 's' : '' }}</small>
      </template>
      <template slot="footer">
        <div class="has-text-left">
          <b-dropdown @change="onPerPageChange" :value="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="2" aria-role="listitem">2 per page</b-dropdown-item>
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
import Form from "vform";
import JobModalVue from "@/components/modals/JobModal.vue";
import { mapGetters, mapActions, mapMutations } from "vuex";
import EnrollmentFormSettingsModalVue from "../../components/modals/EnrollmentFormSettingsModal.vue";

export default {
  props: ["conference"],

  data() {
    return {
      detailOpen: [],
      isUpdatingState: false,

      // This will ensure that the details won't open
      // on SV state dropdown click
      ignoreNextToggleClick: false,

      // We use this as a workaround to only 'v-if' the svBidsList
      // when the b-collapse is open
      // It will also close the bidList of other SVs
      // to make sure the DOM is kept small
      showBidsForUser: null
    };
  },

  methods: {
    showEnrollmentFormWeightsSettings() {
      this.$buefy.modal.open({
        parent: this,
        props: {
          value: this.parseEnrollmentForm(
            this.conference.enrollment_form_template
          ),
          update: form => {
            this.templateSettingsChanged(form);
          }
        },
        component: EnrollmentFormSettingsModalVue
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
          this.setIsLoading(true);
          api
            .updateConferenceResetEnrollmentsToEnrolled(this.conference.key)
            .then(({ data }) => {
              this.$buefy.notification.open({
                duration: 5000,
                message: data.message,
                type: "is-success",
                hasIcon: true
              });
            })
            .finally(() => {
              this.setIsLoading(false);
              this.fetchSvs();
            });
        } // onConfirm
      });
    },
    runLottery() {
      this.setIsLoading(true);
      api
        .runLottery(this.conference.key)
        .then(({ data }) => {
          let jobId = data.result;
          this.$buefy.modal.open({
            parent: this,
            props: { id: jobId },
            component: JobModalVue,
            hasModalCard: true,
            onCancel: () => {
              this.fetchSvs();
            }
          });
        })
        .finally(() => {
          this.setIsLoading(false);
          this.fetchSvs();
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
            hasIcon: true
          });
          this.fetchSvs();
        })
        .finally(() => this.setIsLoading(false));
    },
    updateSvState(user, $event) {
      var vform = new Form({
        id: user.permission.id,
        user_id: user.id,
        conference_id: user.permission.conference.id,
        role_id: user.permission.role.id,
        state_id: $event
      });

      this.isUpdatingState = true;
      api
        .updatePermission(vform, user.permission.id)
        .then(({ data }) => {
          user.permission = data.result;
          this.fetchAcceptedCount();
          this.fetchSvs();
        })
        .finally(() => (this.isUpdatingState = false));
    },
    onPageChange(page) {
      this.setPage(page);
      this.fetchSvs();
    },
    onPerPageChange(perPage) {
      this.setPerPage(perPage);
      this.fetchSvs();
    },
    onSort(field, order) {
      this.setSortField(field);
      this.setSortDirection(order);
      this.fetchSvs();
    },
    onSearch(search) {
      this.setSearch(search);
      this.fetchSvs();
    },
    onStatesChange(states) {
      this.setStates(states);
    },
    toggle: function(row) {
      if (this.ignoreNextToggleClick) {
        this.ignoreNextToggleClick = false;
      } else {
        if (this.detailOpen.includes(row.id)) {
          this.detailOpen = [];
        } else {
          this.detailOpen = [row.id];
        }
      }
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
      "setIsLoading"
    ])
  },

  computed: {
    canUpdateEnrollment() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    canRunLottery() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    enrollmentFormTemplate() {
      return this.conference.enrollment_form_template;
    },
    allStates() {
      return this.statesFor("App\\User");
    },
    ...mapGetters("svs", [
      "data",
      "search",
      "sortField",
      "sortDirection",
      "perPage",
      "page",
      "states",
      "isLoading",
      "showWaitlistPosition",
      "showSvAvatar"
    ]),
    ...mapGetters("conference", ["acceptedCount"]),
    ...mapGetters("defines", ["statesFor"]),
    ...mapGetters("auth", ["userIs", "userIsAdminOrChairOrCaptain"])
  }
};
</script>