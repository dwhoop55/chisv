<template>
  <div>
    <b-table
      ref="table"
      :data="users"
      detail-key="id"
      :show-detail-icon="true"
      :opened-detailed="[1]"
      paginated
      per-page="25"
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
          <template>{{ props.row.firstname }}</template>
        </b-table-column>
        <b-table-column field="lastname" label="Lastname" sortable>
          <template>{{ props.row.lastname }}</template>
        </b-table-column>
        <b-table-column field="university" label="University" sortable>
          <template>
            <a
              v-if="props.row.university && props.row.university.id"
              target="_blank"
              :href="props.row.university.url"
            >{{ props.row.university.name }}</a>
            <p v-else-if="props.row.university">{{ props.row.university }}</p>
            <p v-else>N/A</p>
          </template>
        </b-table-column>
        <b-table-column width="130" field="permission.state.id" label="SV State" sortable>
          <template>
            <b-dropdown
              :value="props.row.permission.state.id"
              @change="updateSvState(props.row, $event)"
              aria-role="list"
            >
              <b-taglist class="is-clickable" slot="trigger" role="button" attached>
                <b-tag
                  v-if="canChangeEnrollment"
                  rounded
                  :type="stateType(props.row.permission.state)"
                >
                  <b-icon icon="pencil" size="is-small"></b-icon>
                </b-tag>
                <state-tag :state="props.row.permission.state" />
              </b-taglist>

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
          </template>
        </b-table-column>
        <b-table-column
          v-if="props.row.permission.created_at"
          width="150"
          field="permission.created_at"
          label="enrolled"
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
      </template>

      <template slot="detail" slot-scope="props">
        <article class="media">
          <figure class="media-left">
            <p class="image is-64x64">
              <img v-if="props.row.avatar" :src="userAvatar(props.row)" />
              <img v-else :src="userAvatar(props.row)" />
            </p>
          </figure>
          <div class="media-content">
            <div class="content">
              <p>
                <strong>{{ props.row.firstname }} {{ props.row.lastname }}</strong>
                <small>@test</small>
                <small>31m</small>
                <br />Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Proin ornare magna eros, eu pellentesque tortor vestibulum ut.
                Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
              </p>
            </div>
          </div>
        </article>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p>No users found yet.</p>
          </div>
        </section>
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
      // columns: [],
      canChangeEnrollment: false
    };
  },

  created() {
    this.getUsers();
    this.getStates();
    this.getCan();
  },

  methods: {
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
      this.canChangeEnrollment = await auth.can(
        "update",
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
            // this.columns = Object.keys(this.users[0]);
          } else {
            this.users = null;
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
    toggle(row) {
      this.$refs.table.toggleDetails(row);
    }
  },

  computed: {
    svStates: function() {
      return this.filterStates(this.states, "App\\User");
    }
  }
};
</script>