<template>
  <section>
    <b-tabs expanded :animated="false" v-model="activeTab">
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
              maxlength="300"
              placeholder="Let your users know what the conference is about"
              v-model="generalForm.description"
              type="textarea"
            ></b-input>
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

          <b-field class="buttons" grouped position="is-centered">
            <a :href="`/conference/${conferenceKey}`" class="button">
              <span class="icon">
                <i class="mdi mdi-arrow-left"></i>
              </span>
              <span>Cancel</span>
            </a>
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
            <b-field grouped>
              <b-field label="Active Artwork" expanded>
                <figure v-if="conference.image" class="image">
                  <img :src="conference.image.path" />
                </figure>
                <figure v-else class="image">
                  <small>This is the default image which is active when no image is uploaded</small>
                  <img src="/images/conference-default.jpg" />
                </figure>
              </b-field>

              <b-field label="Replace with">
                <b-upload
                  @input="uploadImage('image', $event)"
                  accept="image/*"
                  :loading="imageForm.busy"
                  v-model="imageForm.image"
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
                      <div v-if="imageForm.image">
                        <p class="tag is-primary">{{imageForm.image.name}}</p>
                        <p class="has-text-success">To upload click Apply below</p>
                      </div>
                    </div>
                  </section>
                </b-upload>
              </b-field>
            </b-field>
          </div>

          <div class="section box">
            <b-field grouped>
              <b-field label="Active Icon" expanded>
                <figure v-if="conference.icon" class="image is-128x128">
                  <img :src="conference.icon.path" />
                </figure>
                <figure v-else class="image is-128x128">
                  <small>This is the default icon which is active when no icon is uploaded</small>
                  <img :src="`https://avatars.dicebear.com/v2/jdenticon/${conference.key}.svg`" />
                </figure>
              </b-field>

              <b-field label="Replace with">
                <b-upload
                  @input="uploadImage('icon', $event)"
                  accept="image/*"
                  :loading="imageForm.busy"
                  v-model="imageForm.icon"
                  drag-drop
                >
                  <section class="section">
                    <div class="content has-text-centered">
                      <p>
                        <b-icon icon="upload" size="is-large"></b-icon>
                      </p>
                      <p>Drop a new icon</p>
                      <div v-if="imageForm.icon">
                        <p class="tag is-primary">{{imageForm.icon.name}}</p>
                        <p class="has-text-success">To upload click Apply below</p>
                      </div>
                    </div>
                  </section>
                </b-upload>
              </b-field>
            </b-field>
          </div>

          <b-field class="buttons" grouped position="is-right">
            <a :href="`/conference/${conferenceKey}`" class="button">
              <span class="icon">
                <i class="mdi mdi-arrow-left"></i>
              </span>
              <span>Cancel</span>
            </a>
            <button :disabled="imageForm.busy" type="submit" class="button is-success">
              <span class="icon">
                <i class="mdi mdi-check"></i>
              </span>
              <span>Apply</span>
            </button>
          </b-field>
        </form>
      </b-tab-item>

      <b-tab-item icon="sign-caution" label="Administrative">
        <b-field class="buttons" grouped position="is-centered">
          <a :href="`/conference/${conferenceKey}`" class="button">
            <span class="icon">
              <i class="mdi mdi-arrow-left"></i>
            </span>
            <span>Cancel</span>
          </a>
          <button
            v-if="canDelete"
            @click="destroy"
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
import moment from "moment-timezone";

export default {
  props: ["canDelete", "conferenceKey"],

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
      conference: null,
      activeTab: 1,
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
        state_id: null,
        enable_bidding: null,
        created_at: null,
        updated_at: null
      }),
      isLoading: true
    };
  },

  mounted() {
    this.load();
  },

  methods: {
    uploadImage: function(type, event) {
      api
        .uploadConferenceImage(this.conference, type, event)
        .then(data => console.log(data))
        .catch(error => {
          throw error;
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
        .updateConference(this.conferenceKey, form)
        .then(data => {
          this.load();
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
    destroy() {
      this.$buefy.dialog.confirm({
        message: `Are your sure you want to delete ${this.conference.name}?`,
        onConfirm: () => {
          this.isLoading = true;
          api
            .destroyConference(this.conferenceKey)
            .then(() => {
              this.goTo("/conference");
            })
            .catch(error => {
              this.$buefy.toast.open({
                message: `An error occured: ${error}`,
                type: "is-danger"
              });
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    },
    load() {
      this.isLoading = true;
      api
        .getConference(this.conferenceKey)
        .then(data => {
          let conference = data.data;
          this.conference = conference;
          this.timezone = conference.timezone;
          this.generalForm.fill(conference);
          this.imageForm.fill(conference);
          this.generalForm.enable_bidding =
            this.generalForm.enable_bidding == "1" ? true : false;
        })
        .catch(error => {
          if (error.response.status == 404) {
            this.goTo("/conference");
          } else {
            throw error;
          }
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>