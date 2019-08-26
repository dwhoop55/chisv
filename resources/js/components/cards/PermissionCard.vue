<template>
  <section>
    <div class="card">
      <div
        class="card-image is-cover"
        :style="`height:300px;${conferenceArtworkBackground(permission.conference)}`"
      >
        <b-field grouped position="is-right">
          <transition name="slide-fade">
            <b-button
              v-if="canRevoke"
              outlined
              @click="confirmRevoke"
              type="is-danger"
              class="has-margin-7"
            >Revoke</b-button>
          </transition>
        </b-field>
      </div>

      <div class="card-content is-paddingless has-padding-b-7 has-padding-r-6">
        <b-taglist
          @click.native="tagClick"
          attached
          :class="{ 'is-clickable': canRevoke, 'is-pulled-right': true }"
        >
          <transition name="slide-fade">
            <b-tag v-if="canRevoke" rounded :type="roleType(permission.role)" size="is-large">
              <b-icon class="has-padding-7" icon="pencil" size="is-small"></b-icon>
            </b-tag>
          </transition>
          <role-tag :role="permission.role" size="is-large" v-if="permission.role" />
          <state-tag size="is-large" v-if="permission.state" :state="permission.state" />
        </b-taglist>

        <div class="has-margin-4">
          <p class="subtitle" v-if="permission.conference">
            <a :href="'/conference/' + permission.conference.key">{{ permission.conference.name }}</a>
          </p>
          <p class="subtitle" v-else>All conferences</p>
        </div>
      </div>
    </div>
    <b-modal @close="$emit('updated')" :active.sync="showEditModal" has-modal-card>
      <edit-permission-modal @updated="$emit('updated')" :permission="permission"></edit-permission-modal>
    </b-modal>
  </section>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["permission"],

  data() {
    return {
      canRevoke: false,
      showEditModal: false
    };
  },

  created() {
    this.checkCan();
  },

  methods: {
    checkCan: function() {
      api
        .can("delete", "Permission", this.permission.id)
        .then(data => {
          this.canRevoke = data.data.result;
        })
        .catch(error => {
          throw error;
        });
    },
    confirmRevoke: function() {
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
        }
      });
    },
    revoke: function() {
      api
        .revokePermission(this.permission.id)
        .then(data => {
          this.$buefy.toast.open({
            type: "is-success",
            message: data.data.message
          });
          this.$emit("revoked", this.permission);
        })
        .catch(error => {
          this.$buefy.toast.open({
            type: "is-danger",
            message: error.message
          });
        });
    },
    tagClick: function() {
      if (this.canRevoke) {
        this.showEditModal = true;
      }
    }
  }
};
</script>
