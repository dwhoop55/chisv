<template>
  <div style="display: grid;">
    <b-upload
      @input="updateImage($event)"
      accept="image/*"
      :loading="isLoading"
      v-model="image"
      drag-drop
    >
      <div class="has-margin-4 has-text-centered">
        <figure :class="`image is-${size}`">
          <img :src="imageSrc" />
        </figure>
        <small v-html="text" />
      </div>
    </b-upload>
    <b-button @click="deleteImage(id)" outlined type="is-danger" v-if="id" icon-left="delete">Remove</b-button>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["model", "size", "type", "text"],

  model: {
    prop: "model"
  },

  data() {
    return {
      isLoading: false,
      image: null
    };
  },

  computed: {
    id() {
      if (this.type == "avatar" && this.model.avatar) {
        return this.model.avatar.id;
      } else if (this.type == "artwork" && this.model.artwork) {
        return this.model.artwork.id;
      } else if (this.type == "icon" && this.model.icon) {
        return this.model.icon.id;
      }
    },
    imageSrc() {
      if (this.type == "avatar") {
        return this.userAvatar(this.model);
      } else if (this.type == "artwork") {
        return this.conferenceArtwork(this.model);
      } else if (this.type == "icon") {
        return this.conferenceIcon(this.model);
      }
    }
  },

  methods: {
    updateModel(image = null) {
      if (this.type == "avatar") {
        this.model.avatar = image;
      } else if (this.type == "artwork") {
        this.model.artwork = image;
      } else if (this.type == "icon") {
        this.model.icon = image;
      }
    },
    updateImage(image) {
      let promise;
      this.isLoading = true;

      if (this.id) {
        // Update existing, since we have an image id
        promise = api.updateImage(this.id, this.image);
      } else {
        promise = api.createImage(this.model, this.type, this.image);
      }

      promise
        .then(data => {
          console.log(data);
          let result = data.data.result;
          this.updateModel(result);
          this.$emit("input", this.model);
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
        .deleteImage(this.id)
        .then(data => {
          this.updateModel();
          this.$forceUpdate();
          this.$emit("input", this.model);
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
