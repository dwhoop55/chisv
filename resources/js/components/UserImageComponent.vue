<template>
  <div>
    <b-upload
      @input="updateImage($event)"
      accept="image/*"
      :loading="isLoading"
      v-model="image"
      drag-drop
    >
      <div class="has-margin-4 has-text-centered">
        <figure class="has-margin-4 image is-128x128">
          <img :src="userAvatar(user)" />
        </figure>
        <p>Drop new image..</p>
      </div>
    </b-upload>
    <b-button
      @click="deleteImage(user.avatar.id)"
      outlined
      type="is-danger"
      v-if="user.avatar && user.avatar.id"
    >Reset to default</b-button>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["user"],

  model: {
    prop: "user"
  },

  data() {
    return {
      isLoading: false,
      image: null
    };
  },

  methods: {
    updateImage(image) {
      let promise;
      this.isLoading = true;

      if (this.user.avatar) {
        promise = api.updateImage(this.user.avatar.id, this.image);
      } else {
        promise = api.createUserImage(this.user, "avatar", this.image);
      }

      promise
        .then(data => {
          let result = data.data.result;
          this.user.avatar = result;
          this.$emit("input", this.user);
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success"
          });
        })
        .catch(error => {
          this.$buefy.notification.open({
            message: error.response.data.errors.image[0],
            type: "is-danger",
            indefinite: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    deleteImage() {
      api
        .deleteImage(this.user.avatar.id)
        .then(data => {
          let result = data.data.result;
          delete this.user.avatar;
          this.$forceUpdate();
          this.$emit("input", this.user);
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success"
          });
        })
        .catch(error => {
          this.$buefy.toast.open({
            duration: 5000,
            message: `Could not delete: ${error.message}`,
            type: "is-danger"
          });
        });
    }
  }
};
</script>
