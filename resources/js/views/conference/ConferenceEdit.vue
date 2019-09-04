<template>
  <section>
    <b-tabs type="is-toggle-rounded" position="is-centered" :animated="false" v-model="activeTab">
      <b-tab-item icon="wrench" label="General">
        <form @submit.prevent="save" @keydown="generalForm.onKeydown($event)">
          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('name') }"
            :message="generalForm.errors.get('name')"
            label="Name"
          >
            <b-input required v-model="generalForm.name" maxlength="70"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('key') }"
            :message="generalForm.errors.get('key')"
            label="Key (https://chisv.org/conference/key)"
          >
            <b-input required v-model="generalForm.key" maxlength="30"></b-input>
          </b-field>

          <b-field
            expanded
            :type="{ 'is-danger': generalForm.errors.has('location') }"
            :message="generalForm.errors.get('location')"
            label="Location"
          >
            <b-input
              required
              v-model="generalForm.location"
              maxlength="70"
              placeholder="e.g. City, State, Country - or - City, Country"
            ></b-input>
          </b-field>

          <b-field grouped>
            <b-field
              expanded
              :type="{ 'is-danger': generalForm.errors.has('timezone_id') }"
              :message="generalForm.errors.get('timezone_id')"
              label="Timezone the conference takes place in"
            >
              <timezone-picker @timezone="(tz) => timezone=tz" v-model="generalForm.timezone_id"></timezone-picker>
            </b-field>
            <b-field
              label="Days the conference is running"
              expanded
              :type="{ 'is-danger': hasDateErrors }"
              :message="dateErrors"
            >
              <b-datepicker
                placeholder="Select a range"
                @input="updateDateRange"
                :value="dateRange"
                range
              ></b-datepicker>
            </b-field>
          </b-field>

          <b-field
            label="Description"
            expanded
            :type="{ 'is-danger': generalForm.errors.has('description') }"
            :message="generalForm.errors.get('description')"
          >
            <b-input
              maxlength="1000"
              placeholder="Let your users know what the conference is about"
              v-model="generalForm.description"
              type="textarea"
            ></b-input>
          </b-field>

          <p>Leave any of the two fields empty to hide the button on the conference page</p>
          <b-field grouped>
            <b-field
              expanded
              :type="{ 'is-danger': generalForm.errors.has('url_name') }"
              :message="generalForm.errors.get('url_name')"
              label="External link caption"
            >
              <b-input
                v-model="generalForm.url_name"
                maxlength="100"
                placeholder="e.g. ACM, Website, More"
              ></b-input>
            </b-field>
            <b-field
              label="External link URL"
              expanded
              :type="{ 'is-danger': generalForm.errors.has('url') }"
              :message="generalForm.errors.get('url')"
            >
              <b-input v-model="generalForm.url" maxlength="300" placeholder="e.g. https://acm.org"></b-input>
            </b-field>
          </b-field>

          <b-field
            label="State"
            expanded
            :type="{ 'is-danger': generalForm.errors.has('state_id') }"
            :message="generalForm.errors.get('state_id')"
          >
            <state-picker :range="[0,10]" v-model="generalForm.state_id"></state-picker>
          </b-field>

          <b-field
            label="Enable bidding on tasks"
            expanded
            :type="{ 'is-danger': generalForm.errors.has('enable_bidding') }"
            :message="generalForm.errors.get('enable_bidding')"
          >
            <b-switch v-model="generalForm.enable_bidding"></b-switch>
          </b-field>

          <b-field class="buttons" grouped position="is-right">
            <button :disabled="generalForm.busy" type="submit" class="button is-success">
              <span class="icon">
                <i class="mdi mdi-check"></i>
              </span>
              <span>Apply</span>
            </button>
          </b-field>
        </form>
      </b-tab-item>

      <b-tab-item icon="image" label="Image">
        <form @submit.prevent="save" @keydown="imageForm.onKeydown($event)">
          <div class="section box">
            <p class="subtitle">Active Artwork</p>
            <div class="columns is-vcentered is-mobile is-multiline">
              <div class="column is-half is-narrow">
                <div v-if="conference && conference.artwork">
                  <b-field>
                    <figure class="image">
                      <img :src="conference.artwork.web_path" />
                    </figure>
                  </b-field>
                  <b-field>
                    <b-button
                      @click.prevent="deleteImage('artwork', conference.artwork.id)"
                      type="is-danger"
                    >Delete this artwork</b-button>
                  </b-field>
                </div>
                <div v-else>
                  <small>This is the default artwork which is active when no image is uploaded</small>
                  <figure class="image">
                    <img src="/images/conference-default.jpg" />
                  </figure>
                </div>
              </div>
              <div class="column is-half">
                <b-upload
                  @input="uploadImage('artwork', $event)"
                  accept="image/*"
                  :loading="isLoading"
                  v-model="imageForm.artwork"
                  drag-drop
                >
                  <section class="section">
                    <div class="content has-text-centered">
                      <p>
                        <b-icon icon="upload" size="is-large"></b-icon>
                      </p>
                      <p>
                        Drop a new artwork (e.g. skyline, buildings, art)
                        <br />related to the conference here
                      </p>
                    </div>
                  </section>
                </b-upload>
              </div>
            </div>
          </div>

          <div class="section box">
            <p class="subtitle">Active Icon</p>
            <div class="columns is-vcentered is-mobile is-multiline">
              <div class="column is-half is-narrow">
                <div v-if="conference && conference.icon">
                  <b-field>
                    <figure class="image is-128x128">
                      <img :src="conference.icon.web_path" />
                    </figure>
                  </b-field>
                  <b-field>
                    <b-button
                      @click.prevent="deleteImage('icon', conference.icon.id)"
                      type="is-danger"
                    >Delete this icon</b-button>
                  </b-field>
                </div>
                <div v-else>
                  <small>This is the default icon which is active when no icon is uploaded</small>
                  <figure class="image is-128x128">
                    <img :src="`https://avatars.dicebear.com/v2/jdenticon/${conference.key}.svg`" />
                  </figure>
                </div>
              </div>
              <div class="column is-half">
                <b-upload
                  @input="uploadImage('icon', $event)"
                  accept="image/*"
                  :loading="isLoading"
                  v-model="imageForm.icon"
                  drag-drop
                >
                  <section class="section">
                    <div class="content has-text-centered">
                      <p>
                        <b-icon icon="upload" size="is-large"></b-icon>
                      </p>
                      <p>Drop a new icon</p>
                    </div>
                  </section>
                </b-upload>
              </div>
            </div>
          </div>
        </form>
      </b-tab-item>

      <b-tab-item icon="sign-caution" label="Administrative">
        <b-field class="buttons" grouped position="is-right">
          <button
            v-if="canDelete"
            @click="deleteConference"
            class="button is-danger is-pulled-right"
          >Delete this conference</button>
        </b-field>
      </b-tab-item>
    </b-tabs>
    <b-loading :is-full-page="false" :active.sync="isLoading || generalForm.busy"></b-loading>
  </section>
</template>

<script>
import { Form } from "vform";
import api from "@/api.js";
import auth from "@/auth.js";
import moment from "moment-timezone";

export default {
  props: ["conference"],
  model: {
    prop: "conference",
    event: "updated"
  },

  computed: {
    dateErrors: function() {
      if (this.hasDateErrors) {
        return (
          this.generalForm.errors.get("start_date") +
          "<br/> " +
          this.generalForm.errors.get("end_date")
        );
      }
    },
    hasDateErrors: function() {
      return (
        this.generalForm.errors.has("start_date") ||
        this.generalForm.errors.has("end_date")
      );
    },
    dateRange: function() {
      if (
        this.generalForm.start_date &&
        this.generalForm.end_date &&
        this.timezone
      ) {
        return [
          new Date(this.generalForm.start_date),
          new Date(this.generalForm.end_date)
        ];
      }
    }
  },

  data() {
    return {
      canDelete: false,
      activeTab: 0,
      timezone: null,
      imageForm: new Form({
        image: null,
        icon: null
      }),
      generalForm: new Form({
        name: null,
        key: this.conferenceKey,
        location: null,
        timezone_id: null,
        start_date: null,
        end_date: null,
        description: null,
        url_name: null,
        url: null,
        state_id: null,
        enable_bidding: null,
        created_at: null,
        updated_at: null
      }),
      isLoading: false
    };
  },

  created() {
    this.getCan();
    this.timezone = this.conference.timezone;
    this.generalForm.fill(this.conference);
    this.imageForm.fill(this.conference);
    this.generalForm.enable_bidding =
      this.generalForm.enable_bidding == "1" ? true : false;
  },

  methods: {
    getCan: async function() {
      this.canDelete = await auth.can(
        "delete",
        "Conference",
        this.conference.id
      );
    },
    deleteImage: function(type, id) {
      api
        .deleteImage(id)
        .then(data => {
          let result = data.data.result;
          let conference = this.conference;
          if (type == "artwork") {
            conference.artwork = result;
          } else {
            conference.icon = result;
          }
          this.$emit("updated", conference);
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
    },
    uploadImage: function(type, image) {
      // We need to check if there is an existing image and update the image only
      // Or upload a entire new one
      let promise;
      switch (type) {
        case "artwork":
          if (this.conference.artwork) {
            promise = api.updateImage(this.conference.artwork.id, image);
          } else {
            promise = api.createConferenceImage(this.conference, type, image);
          }
          break;
        case "icon":
          if (this.conference.icon) {
            promise = api.updateImage(this.conference.icon.id, image);
          } else {
            promise = api.createConferenceImage(this.conference, type, image);
          }
          break;
      }

      this.isLoading = true;
      promise
        .then(data => {
          let result = data.data.result;
          let conference = this.conference;
          if (type == "artwork") {
            conference.artwork = result;
          } else {
            conference.icon = result;
          }
          this.$emit("updated", conference);
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
    updateDateRange: function($event) {
      this.generalForm.start_date = $event[0].toMySqlDate();
      this.generalForm.end_date = $event[1].toMySqlDate();
    },
    save() {
      var form;
      switch (this.activeTab) {
        case 0: //general
          form = this.generalForm;
          break;
        case 1: //image
          form = this.imageForm;
          break;
      }
      this.isLoading = true;
      api
        .updateConference(this.conference.key, form)
        .then(data => {
          this.$emit("updated", data.data.result);
          this.$buefy.toast.open({
            message: data.data.message,
            type: "is-success"
          });
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.$buefy.toast.open({
              duration: 5000,
              message: `Some fields are invalid`,
              type: "is-danger"
            });
          } else {
            this.$buefy.toast.open({
              duration: 5000,
              message: `Could not save conference: ${error.message}`,
              type: "is-danger"
            });
          }
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    deleteConference() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.conference.name}?`,
        onConfirm: () => {
          this.isLoading = true;
          api
            .deleteConference(this.conference.key)
            .then(() => {
              this.goTo("/conference");
            })
            .catch(error => {
              this.$buefy.toast.open({
                message: `An error occured: ${error.message}`,
                type: "is-danger"
              });
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    }
  }
};
</script>