<template>
  <div>
    <b-field grouped>
      <b-input
        expanded
        v-model="searchString"
        placeholder="Search anything..."
        type="search"
        icon="magnify"
      ></b-input>

      <b-dropdown
        class="control"
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
        :value="enrollmentFormTemplate"
      ></enrollment-form-settings-button>
    </b-field>
    <b-table
      ref="table"
      @click="toggle($event)"
      :data="filteredUsers"
      detail-key="id"
      :show-detail-icon="true"
      paginated
      :per-page="perPage"
      detailed
      :loading="isLoading"
      :hoverable="true"
      sort-icon="chevron-up"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
      default-sort="permission.state.id"
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
        <b-table-column field="university" label="University" sortable>
          <template>
            <a
              v-if="props.row.university && props.row.university.id"
              target="_blank"
              :title="props.row.university.name"
              :href="props.row.university.url"
            >{{ props.row.university.name | textlimit(35) }}</a>
            <p
              v-else-if="props.row.university"
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
        <b-table-column width="130" field="permission.state.id" label="SV State" sortable>
          <template>
            <b-dropdown
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
                <span>{{ props.row.permission.state.name }}</span>
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
        <b-table-column v-if="canUpdateEnrollment" width="150" label="Lottery position" sortable>
          <template>
            <p>test</p>
          </template>
        </b-table-column>
      </template>

      <template slot="detail" slot-scope="props">
        <strong>{{ props.row.firstname }} {{ props.row.lastname }}</strong>

        <br />
        {{ props.row.city ? props.row.city.name + ", " : "" }}
        {{ props.row.region.name }}, {{ props.row.country.name }}
        <br />

        <div v-if="props.row.degree">
          Study Program:
          {{ props.row.degree.name }}
        </div>Enrollment form:
        <enrollment-form-summary
          class="section has-padding-t-8"
          v-if="props.row.permission.enrollment_form"
          v-model="props.row.permission.enrollment_form"
        ></enrollment-form-summary>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon icon="emoticon-sad" size="is-large"></b-icon>
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
          <b-dropdown v-model="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="5" aria-role="listitem">5 per page</b-dropdown-item>
            <b-dropdown-item value="10" aria-role="listitem">10 per page</b-dropdown-item>
            <b-dropdown-item value="20" aria-role="listitem">20 per page</b-dropdown-item>
            <b-dropdown-item value="40" aria-role="listitem">40 per page</b-dropdown-item>
            <b-dropdown-item value="80" aria-role="listitem">80 per page</b-dropdown-item>
            <b-dropdown-item value="100" aria-role="listitem">100 per page</b-dropdown-item>
            <b-dropdown-item value="200" aria-role="listitem">200 per page</b-dropdown-item>
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

export default {
  props: ["conference"],

  data() {
    return {
      users: [],
      states: [],
      isLoading: true,
      searchString: "",
      selectedStates: [],
      perPage: 20,
      // This will ensure that the details won't open
      // on SV state dropdown click
      ignoreNextToggleClick: false,
      canUpdateEnrollment: false,

      enrollmentFormTemplate: null
    };
  },

  created() {
    this.getStates();
    this.getUsers();
    this.getCan();
    this.getEnrollmentFormTemplate();
  },

  methods: {
    getEnrollmentFormTemplate() {
      api
        .getEnrollmentFormTemplate(this.conference.enrollment_form_id)
        .then(data => {
          this.enrollmentFormTemplate = this.parseEnrollmentForm(data.data);
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
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: error.message,
            type: "is-danger",
            hasIcon: true
          });
        });
    },
    getCan: async function() {
      this.canUpdateEnrollment = await auth.can(
        "updateEnrollment",
        "Conference",
        this.conference.id
      );
    },
    getUsers: function() {
      api
        .getConferenceUsers(this.conference.key)
        .then(data => {
          if (data.data.length > 0) {
            this.users = data.data;
          } else {
            this.users = [];
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
          this.isLoading = false;
        });
    },
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
    },
    filteredUsers: function() {
      // No users? No Output!
      if (!this.users) {
        return null;
      }

      // First filter states
      var users = this.users.filter(user => {
        if (
          user.permission.state &&
          this.selectedStates.includes(user.permission.state.id)
        ) {
          return true;
        }
      });

      // Then take this output from above
      // and filter for the searchField
      return users.filter(user => {
        // No search input? Always show item
        if (this.searchString == "") return true;
        return this.stringInObject(this.searchString, user);
      });
    }
  }
};
</script>