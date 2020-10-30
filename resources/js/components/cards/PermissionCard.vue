<template>
  <section>
    <div class="card">
      <div
        class="card-image is-cover"
        :style="`height:300px;${conferenceArtworkBackground(
          permission.conference
        )}`"
      >
        <b-field grouped position="is-right">
          <transition name="slide-right-fade">
            <b-button
              v-if="canRevoke"
              outlined
              @click="confirmRevoke"
              type="is-danger"
              class="has-margin-7"
              >Revoke</b-button
            >
          </transition>
          <transition name="slide-right-fade">
            <b-button
              v-if="permission.enrollment_form"
              outlined
              @click="showEnrollmentForm()"
              type="is-light"
              class="has-margin-t-7 has-margin-r-7"
              >{{ canEditForm ? "Edit" : "Show" }} Enrollment Form</b-button
            >
          </transition>
        </b-field>
      </div>

      <div class="card-content is-paddingless has-padding-b-7 has-padding-r-6">
        <b-taglist
          @click.native="canEdit ? showEditModal() : null"
          attached
          :class="{ 'is-clickable': canEdit, 'is-pulled-right': true }"
        >
          <role-tag
            :role="permission.role"
            size="is-large"
            v-if="permission.role"
          />
          <state-tag
            size="is-large"
            v-if="permission.state"
            :state="permission.state"
          />
          <b-tag
            v-if="canEdit"
            rounded
            :type="stateType(permission.state)"
            size="is-large"
          >
            <b-icon
              class="has-padding-7"
              icon="pencil"
              size="is-small"
            ></b-icon>
          </b-tag>
        </b-taglist>

        <div class="has-margin-4">
          <p class="subtitle" v-if="permission.conference">
            <router-link
              :to="{
                name: 'conference',
                params: { key: permission.conference.key },
              }"
              >{{ permission.conference.name }}</router-link
            >
          </p>
          <p class="subtitle" v-else>All conferences</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import api from "@/api.js";
import { mapGetters } from "vuex";
import EnrollmentFormModalVue from "../modals/EnrollmentFormModal.vue";
import PermissionModalVue from "../modals/PermissionModal.vue";

export default {
  props: ["permission"],

  methods: {
    showEditModal() {
      this.$buefy.modal.open({
        component: PermissionModalVue,
        parent: this,
        props: {
          permission: this.permission,
          onUpdated: () => this.$emit("updated"),
        },
        hasModalCard: true,
      });
    },
    showEnrollmentForm() {
      if (!this.permission.enrollment_form) {
        console.log("No enrollment form given");
        return;
      }
      this.$buefy.modal.open({
        component: EnrollmentFormModalVue,
        parent: this,
        props: {
          canEdit: this.canEditForm,
          form: this.parseEnrollmentForm(this.permission.enrollment_form),
          onUpdated: () => this.$emit("updated"),
        },
        hasModalCard: true,
      });
    },
    confirmRevoke: function () {
      let message = `Are you sure you want to <b>revoke</b> ${this.permission.role.name} permissions?`;
      let extra = "";
      if (this.permission.role.name == "sv") {
        extra =
          "<br/><br/>Remember, when you revoke sv permission you could \
           <b>loose access to the user</b> when he/she is not associated \
           otherwise with the conferences you can manage. \
           <br/>To gain access again the user has to enroll again.";
      }
      this.$buefy.dialog.confirm({
        title: `Revoking ${this.permission.role.name} permission`,
        message: message + extra,
        confirmText: `Yes, revoke ${this.permission.role.name} permission`,
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          this.revoke();
        },
      });
    },
    revoke: function () {
      api.deletePermission(this.permission.id).then((data) => {
        this.$buefy.toast.open({
          type: "is-success",
          message: "Revoked",
        });
        this.$emit("revoked", this.permission);
      });
    },
  },

  computed: {
    canEditForm() {
      return this.permission.conference?.state?.name == "enrollment";
    },
    canRevoke() {
      return (
        this.userIs("admin") ||
        this.userIs("chair", this.permission.conference?.key)
      );
    },
    canEdit() {
      return (
        this.permission.role.name == "sv" &&
        (this.userIs("admin") ||
          this.userIs("chair", this.permission.conference?.key))
      );
    },
    ...mapGetters("auth", ["userIs"]),
  },
};
</script>
