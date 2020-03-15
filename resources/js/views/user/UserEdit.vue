<template>
  <div class="columns is-centered">
    <div class="column is-two-thirds">
      <b-tabs
        :value="tab"
        @input="setTab($event)"
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

      <b-loading :is-full-page="false" :active="isLoading"></b-loading>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api.js";
import { mapGetters, mapActions, mapMutations } from "vuex";

export default {
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
    },
    canGrant() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    canDelete() {
      return this.userIs("admin") || this.userIs("chair", this.conference.key);
    },
    ...mapGetters("profile", ["tab"]),
    ...mapGetters("auth", ["userIs"])
  },

  data() {
    return {
      user: null,
      id: this.$route.params.id,
      isLoading: true,
      showGrantModal: false
    };
  },

  mounted() {
    this.getUser();
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
              this.$router.replace({ name: "users" });
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
    getUser() {
      this.isLoading = true;
      api
        .getUser(this.id)
        .then(data => {
          this.user = data.data;
        })
        .catch(error => {
          if (error.response.status == 403 || error.response.status == 404) {
            this.$router.replace({ name: "conferences" });
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
    },
    ...mapMutations("profile", ["setTab"])
  }
};
</script>