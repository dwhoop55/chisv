<template>
  <div class="card">
    <div class="card-image is-cover" :style="backgroundImage">
      <b-button
        v-if="canRevoke"
        outlined
        @click="confirmRevoke"
        type="is-danger is-pulled-right has-margin-7"
      >Revoke</b-button>
    </div>

    <div class="card-content is-paddingless has-padding-b-7 has-padding-r-6">
      <state-tag
        class="is-pulled-right has-margin-l-7"
        size="is-large"
        v-if="permission.state"
        :state="permission.state"
      />
      <role-tag
        class="is-pulled-right has-margin-l-7"
        :role="permission.role"
        size="is-large"
        v-if="permission.role"
      />
      <div class="has-margin-4">
        <p class="subtitle" v-if="permission.conference">
          <a :href="'/conference/' + permission.conference.key">{{ permission.conference.name }}</a>
        </p>
        <p class="subtitle" v-else>All conferences</p>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/api.js";
import { setTimeout } from "timers";

export default {
  props: ["permission"],

  data() {
    return {
      canRevoke: false
    };
  },

  created() {
    this.checkCan();
  },

  computed: {
    hasImage: function() {
      return this.conference && this.conference.image;
    },
    backgroundImage: function() {
      if (this.hasImage) {
        return `height: 200px; background-image:url(${this.permission.conference.image.path})`;
      } else {
        return "height: 200px; background-image:url('/images/conference-default.jpg')";
      }
    }
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
           otherwise with the conferences you can manage<br/>To gain access again the user has to enroll again.";
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
          this.removeFromParent();
        })
        .catch(error => {
          this.$buefy.toast.open({
            type: "is-danger",
            message: error.message
          });
        });
    },
    removeFromParent: function() {
      this.$emit("revoked", this.permission);
    }
  }
};
</script>
