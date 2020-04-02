<template>
  <transition name="fade">
    <div v-if="user" class="columns is-centered">
      <div class="column is-two-thirds">
        <b-tabs
          :value="tab"
          @input="setTab($event)"
          :animated="false"
          position="is-left"
          type="is-boxed"
        >
          <b-tab-item icon="format-list-bulleted" label="Conferences">
            <b-button v-if="canGrant" @click="showGrantModal()" class="is-pulled-right">Grant</b-button>

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
          </b-tab-item>

          <b-tab-item icon="account" label="Profile">
            <user-edit-profile v-model="user"></user-edit-profile>
          </b-tab-item>

          <b-tab-item icon="key" label="Password">
            <user-edit-password v-model="user"></user-edit-password>
          </b-tab-item>
        </b-tabs>

        <b-button v-if="canDelete" type="is-danger" @click="deleteUser()">Delete user</b-button>

        <b-loading :is-full-page="false" :active="isLoading"></b-loading>
      </div>
    </div>
  </transition>
</template>

<script>
import Form from "vform";
import api from "@/api.js";
import { mapGetters, mapActions, mapMutations } from "vuex";
import PermissionModalVue from "../../components/modals/PermissionModal.vue";

export default {
  name: "UserEdit",
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
      return this.userIs("admin") || this.userIs("chair");
    },
    canDelete() {
      return (
        this.user?.id != this.authUser?.id &&
        (this.userIs("admin") || this.userIs("chair"))
      );
    },
    routeId() {
      return this.$route.params.id;
    },
    ...mapGetters("profile", ["tab"]),
    ...mapGetters("auth", { userIs: "userIs", authUser: "user" })
  },

  data() {
    return {
      user: null,
      isLoading: true
    };
  },

  created() {
    // Register a watcher to keep the user model up to date
    this.$watch(
      "routeId",
      function(newVal, oldVal) {
        this.getUser(newVal);
      },
      {
        immediate: true
      }
    );
  },

  methods: {
    showGrantModal() {
      this.$buefy.modal.open({
        parent: this,
        component: PermissionModalVue,
        props: {
          user: this.user,
          onCreated: this.getUser
        },
        hasModalCard: true
      });
    },
    deleteUser() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.user.firstname} ${this.user.lastname}?`,
        type: "is-danger",
        onConfirm: () => {
          api.deleteUser(this.user.id).then(() => {
            this.fetchUsers();
            this.$router.go(-1);
          });
        }
      });
    },
    getUser(id) {
      this.isLoading = true;
      api
        .getUser(id)
        .then(({ data }) => {
          this.user = data;
          this.$forceUpdate();
        })
        .catch(error => {
          if (error.response.status == 403) {
            this.$buefy.notification.open({
              type: "is-danger",
              duration: 10000,
              message:
                "No intersecting conferences. Ask admin to add user to conference"
            });
            this.$router.go(-1);
          } else if (error.response.status == 404) {
            this.$router.replace("/");
          }
        })
        .finally(() => (this.isLoading = false));
    },
    ...mapMutations("profile", ["setTab"]),
    ...mapActions("userIndex", ["fetchUsers"])
  }
};
</script>