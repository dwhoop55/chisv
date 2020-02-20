<template>
  <section>
    <b-tabs
      :value="activeTab"
      @input="$store.commit('PROFILE_TAB', $event)"
      :animated="false"
      position="is-left"
      type="is-boxed"
    >
      <b-tab-item icon="format-list-bulleted" label="Conferences">
        <div v-if="user">
          <b-button v-if="canGrant" @click="showGrantModal=true" class="is-pulled-right">Grant</b-button>
          <b-modal :active.sync="showGrantModal" has-modal-card>
            <permission-modal v-if="user" @created="getUser()" :user="user"></permission-modal>
          </b-modal>

          <div class="subtitle has-margin-t-3">
            <p v-if="hasActivePermissions">Active conferences</p>
            <p v-else>Not associated to active conferences</p>
          </div>
          <div class="column" v-for="permission in activePermissions" v-bind:key="permission.id">
            <permission-card @revoked="getUser()" @updated="getUser()" :permission="permission" />
          </div>

          <div class="subtitle has-margin-t-3">
            <p v-if="hasPastPermissions">Past conferences</p>
          </div>
          <div class="column" v-for="permission in pastPermissions" v-bind:key="permission.id">
            <permission-card @revoked="getUser()" @updated="getUser()" :permission="permission" />
          </div>
        </div>
      </b-tab-item>

      <b-tab-item v-if="user" icon="account" label="Profile">
        <user-edit-profile v-model="user"></user-edit-profile>
      </b-tab-item>

      <b-tab-item v-if="user" icon="key" label="Password">
        <user-edit-password v-model="user"></user-edit-password>
      </b-tab-item>

      <b-tab-item v-if="canDelete" icon="sign-caution" label="Delete">
        <b-field class="section" grouped position="is-centered">
          <button @click="deleteUser" class="button is-danger is-pulled-right">Delete this user</button>
        </b-field>
      </b-tab-item>
    </b-tabs>

    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
import Form from "vform";
import api from "@/api.js";
import auth from "@/auth.js";

export default {
  props: ["id"],

  computed: {
    activePermissions: function() {
      return this.user.permissions.filter(function(permission) {
        return permission.conference && permission.conference.state_id != 6;
      });
    },
    hasActivePermissions: function() {
      return this.activePermissions.length != 0;
    },
    pastPermissions: function() {
      return this.user.permissions.filter(function(permission) {
        return !permission.conference || permission.conference.state_id == 6;
      });
    },
    hasPastPermissions: function() {
      return this.pastPermissions.length != 0;
    }
  },

  data() {
    return {
      user: null,
      isLoading: true,
      activeTab: this.$store.getters.profileTab,
      showGrantModal: false,
      canGrant: false,
      canDelete: false
    };
  },

  mounted() {
    this.getUser();
    this.getCan();
  },

  methods: {
    deleteUser() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.user.firstname} ${this.user.lastname}?`,
        type: "is-danger",
        onConfirm: () => {
          api
            .deleteUser(this.user.id)
            .then(() => {
              this.goTo("/user");
            })
            .catch(error => {
              this.$buefy.notification.open({
                duration: 5000,
                message: `Error: ${error.message}`,
                type: "is-danger",
                hasIcon: true
              });
            });
        }
      });
    },
    async getCan() {
      this.canGrant = await auth.can("create", "Permission");
      this.canDelete = await auth.can("delete", "User", this.user.id);
    },
    getUser() {
      this.isLoading = true;
      api
        .getUser(this.id)
        .then(data => {
          this.user = data.data;
        })
        .catch(error => {
          if (error.response.status == 403) {
            // Unauthorized
            this.goTo("/");
          }
          this.$buefy.notification.open({
            duration: 5000,
            message: `Could not fetch user: ${error.message}`,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>