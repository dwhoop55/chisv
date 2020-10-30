<template>
  <transition name="fade">
    <div v-if="user" class="columns is-centered">
      <div class="column is-two-thirds">
        <div class="level is-mobile">
          <div class="level-left">
            <div class="level-item">
              <p class="subtitle">{{ user.firstname }} {{ user.lastname }}</p>
            </div>
            <div v-if="canDelete" class="level-item">
              <b-button
                outlined
                size="is-small"
                type="is-danger"
                @click="deleteUser()"
                >Delete</b-button
              >
            </div>
            <div v-if="canLoginAs" class="level-item">
              <b-button
                outlined
                size="is-small"
                type="is-primary"
                @click="onLoginAs(user.id)"
                >Become this user</b-button
              >
            </div>
          </div>
        </div>

        <b-tabs
          :value="tab"
          @input="setTab($event)"
          :animated="false"
          position="is-left"
          type="is-boxed"
        >
          <b-tab-item icon="format-list-bulleted" label="Conferences">
            <b-button
              v-if="canGrant"
              @click="showGrantModal()"
              class="is-primary is-pulled-right"
              >Grant</b-button
            >

            <div class="subtitle has-margin-t-3">
              <p v-if="hasActivePermissions">Active conferences</p>
              <p v-else>Not associated to active conferences</p>
            </div>
            <div
              class="column"
              v-for="permission in activePermissions"
              v-bind:key="permission.id"
            >
              <permission-card
                @revoked="getUser()"
                @updated="getUser()"
                :permission="permission"
              />
            </div>

            <div class="subtitle has-margin-t-3">
              <p v-if="hasPastPermissions">Past conferences</p>
            </div>
            <div
              class="column"
              v-for="permission in pastPermissions"
              v-bind:key="permission.id"
            >
              <permission-card
                @revoked="getUser()"
                @updated="getUser()"
                :permission="permission"
              />
            </div>
          </b-tab-item>

          <b-tab-item icon="account" label="Profile">
            <user-edit-profile v-model="user"></user-edit-profile>
          </b-tab-item>

          <b-tab-item icon="key" label="Password">
            <user-edit-password v-model="user"></user-edit-password>
          </b-tab-item>

          <b-tab-item
            icon="gesture-tap-button"
            label="UI"
            v-if="user.id == authUser.id"
          >
            <user-edit-ui></user-edit-ui>
          </b-tab-item>
        </b-tabs>

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
    activePermissions: function () {
      return this.user.permissions.filter(function (permission) {
        return permission.conference && permission.conference.state_id != 6;
      });
    },
    hasActivePermissions: function () {
      return this.activePermissions.length != 0;
    },
    pastPermissions: function () {
      return this.user.permissions.filter(function (permission) {
        return !permission.conference || permission.conference.state_id == 6;
      });
    },
    hasPastPermissions: function () {
      return this.pastPermissions.length != 0;
    },
    canGrant() {
      return this.userIs("admin") || this.userIs("chair");
    },
    canDelete() {
      return this.user?.id != this.authUser?.id && this.userIs("admin");
    },
    canLoginAs() {
      return (
        this.user?.id != this.authUser?.id &&
        (this.userIs("admin") || this.userIs("chair"))
      );
    },
    routeId() {
      return this.$route.params.id;
    },
    ...mapGetters("profile", ["tab"]),
    ...mapGetters("auth", { userIs: "userIs", authUser: "user" }),
  },

  data() {
    return {
      user: null,
      isLoading: true,
    };
  },

  created() {
    // Register a watcher to keep the user model up to date
    this.$watch(
      "routeId",
      function (newVal, oldVal) {
        this.getUser(newVal);
      },
      {
        immediate: true,
      }
    );
  },

  methods: {
    onLoginAs() {
      this.$buefy.dialog.confirm({
        title: `Login As`,
        message: `Are your sure you want to login as\
                  <b>${this.user.firstname} ${this.user.lastname}</b>?\
                  <br>
                  <br>
                  If you continue this will remove your local frontend preferences, log you out\
                  and then log you in as if you had used the SV's credentials.
                  <br>
                  <br>
                  This action might fail if the user is not one of your\
                  SVs or has additional higher permissions.\
                  <br>
                  <br>
                  To get back to your own session you will have to logout and log back\
                  in with your own credentials.
                  `,
        type: "is-danger",
        icon: "guy-fawkes-mask",
        hasIcon: true,
        confirmText: "I know what I am doing!",
        onConfirm: () => {
          this.loginAs(this.user.id);
        },
      });
    },
    showGrantModal() {
      this.$buefy.modal.open({
        parent: this,
        component: PermissionModalVue,
        props: {
          user: this.user,
          onCreated: this.getUser,
        },
        hasModalCard: true,
      });
    },
    deleteUser() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.user.firstname} ${this.user.lastname}?\
        <br><br><b>This will also delete all bids and assignments for any\
         conference the users might have interacted with!</b>`,
        type: "is-danger",
        icon: "emoticon-dead",
        hasIcon: true,
        confirmText: "PURGE!",
        onConfirm: () => {
          api.deleteUser(this.user.id).then(() => {
            this.fetchUsers();
            this.$router.go(-1);
          });
        },
      });
    },
    getUser(id) {
      this.isLoading = true;
      api
        .getUser(id || this.user.id)
        .then(({ data }) => {
          this.user = data;
          document.title = `${this.user.firstname} ${this.user.lastname} - chisv`;
          this.$forceUpdate();
        })
        .catch((error) => {
          if (error.response.status == 403) {
            this.$buefy.notification.open({
              type: "is-danger",
              duration: 10000,
              message:
                "No intersecting conferences. Ask admin to add user to conference",
            });
            this.$router.go(-1);
          } else if (error.response.status == 404) {
            this.$router.push("/");
          }
        })
        .finally(() => (this.isLoading = false));
    },
    ...mapMutations("profile", ["setTab"]),
    ...mapActions("userIndex", ["fetchUsers"]),
    ...mapActions("auth", ["loginAs"]),
  },
};
</script>