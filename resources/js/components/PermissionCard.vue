<template>
  <div class="card">
    <div
      class="card-image is-cover"
      :style="{ 
        'height: 200px':  true,
        'background-image:url(\'/images/conference-default.jpg\')': !hasImage,
        backgroundImage: hasImage
      }"
      style="height: 200px; background-image:url('/images/conference-default.jpg')"
    >
      <b-button outlined @click="confirmRevoke" type="is-danger is-pulled-right has-margin-7">Revoke</b-button>
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

export default {
  props: ["permission"],

  computed: {
    hasImage: function() {
      return this.conference && this.conference.image;
    },
    backgroundImage: function() {
      return `background-image:url(${this.permission.conference.image.path})`;
    }
  },

  methods: {
    confirmRevoke: function() {
      this.$buefy.dialog.confirm({
        message: `Revoke ${this.permission.role.name} role on ${this.permission.conference.key}?`,
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
            message: "The permission was revoked"
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
      this.$$parent.user.permissions.$remove(this.permission);
    }
  }
};
</script>
