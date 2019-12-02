<template>
  <div class="modal-card" style="width: 1000px; max-width:100%">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ form.name }}</p>
    </header>
    <section class="modal-card-body">
      <b-field grouped>
        <b-field
          expanded
          required
          :type="{ 'is-danger': form.errors.has('name') }"
          :message="form.errors.get('name')"
          label="Name"
          label-position="on-border"
        >
          <b-input required v-model="form.name" maxlength="255"></b-input>
        </b-field>
        <b-field
          expanded
          :type="{ 'is-danger': form.errors.has('location') }"
          :message="form.errors.get('location')"
          label="Location"
          label-position="on-border"
        >
          <b-input required v-model="form.location" maxlength="255"></b-input>
        </b-field>
      </b-field>

      <b-field
        expanded
        :type="{ 'is-danger': form.errors.has('description') }"
        :message="form.errors.get('description')"
        label="Description"
        label-position="on-border"
      >
        <b-input
          maxlength="1000"
          placeholder="Let your SVs know what the task is about"
          v-model="form.description"
          type="textarea"
        ></b-input>
      </b-field>

      <b-field class="section" grouped group-multiline>
        <b-field
          :type="{ 'is-danger': form.errors.has('date') }"
          :message="form.errors.get('date')"
          :label="form.date | moment('ll')"
          label-position="on-border"
        >
          <b-datepicker
            inline
            :value="new Date(form.date)"
            @input="form.date = $event.toMySqlDate()"
            :events="calendarEvents"
            indicators="bars"
            :mobile-native="false"
          >
            <template>
              <small>Legend</small>
              <br />
              <b-tag rounded type="is-primary">Conference days</b-tag>
              <b-tag rounded type="is-warning">Day with other tasks</b-tag>
            </template>
          </b-datepicker>
        </b-field>

        <b-field
          label-position="on-border"
          label="Start time"
          :type="{ 'is-danger': form.errors.has('start_at') }"
          :message="form.errors.get('start_at')"
        >
          <b-timepicker
            @input="setTime('start', $event)"
            :value="dateFromTime(form.start_at)"
            inline
          ></b-timepicker>
        </b-field>
        <b-field
          label-position="on-border"
          label="End time"
          :type="{ 'is-danger': form.errors.has('end_at') }"
          :message="form.errors.get('end_at')"
        >
          <b-timepicker @input="setTime('end', $event)" :value="dateFromTime(form.end_at)" inline></b-timepicker>
        </b-field>
        <b-field
          expanded
          label-position="on-border"
          label="Total hours"
          :type="{ 'is-danger': form.errors.has('hours') }"
          :message="form.errors.get('hours')"
        >
          <b-input required expanded min="0" max="24" v-model="form.hours"></b-input>
          <p class="control">
            <b-button @click="calculateDuration()" class="button is-primary">Reset</b-button>
          </p>
        </b-field>
      </b-field>

      <b-field grouped group-multiline>
        <b-field
          expanded
          label-position="on-border"
          label="Max SVs for this task"
          :type="{ 'is-danger': form.errors.has('slots') }"
          :message="form.errors.get('slots')"
        >
          <b-numberinput min="1" v-model="form.slots"></b-numberinput>
        </b-field>
        <b-field
          expanded
          label-position="on-border"
          label="Priority"
          :type="{ 'is-danger': form.errors.has('priority') }"
          :message="form.errors.get('priority')"
        >
          <b-numberinput min="1" max="3" v-model="form.priority"></b-numberinput>
        </b-field>
      </b-field>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Cancel</b-button>
      <b-button @click="save()" type="is-success">{{ this.task.id ? 'Apply' : 'Create'}}</b-button>
    </section>
    <b-loading :is-full-page="false" :active="isLoading" />
  </div>
</template>

<script>
import api from "@/api.js";
import { Form } from "vform";

export default {
  props: ["task", "calendarEvents", "updated"],
  data() {
    return {
      form: new Form({
        name: this.task.name,
        description: this.task.description,
        location: this.task.location,
        date: this.task.date,
        start_at: this.task.start_at,
        end_at: this.task.end_at,
        priority: parseInt(this.task.priority),
        slots: parseInt(this.task.slots),
        hours: this.task.hours,
        conference_id: this.task.conference_id
      }),
      isLoading: false
    };
  },

  methods: {
    save() {
      if (this.task && this.task.id) {
        // Update request
        this.isLoading = true;
        api
          .updateTask(this.form, this.task.id)
          .then(data => {
            this.updated();
            this.$parent.close();
          })
          .catch(error => {
            throw error;
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        // Create request
        this.isLoading = true;
        api
          .createTask(this.form)
          .then(data => {
            this.updated();
            this.$parent.close();
          })
          .catch(error => {
            throw error;
          })
          .finally(() => {
            this.isLoading = false;
          });
      }
    },
    setTime(which, time) {
      if (which == "start") {
        this.form.start_at = time.toMySqlTime();
      } else if (which == "end") {
        this.form.end_at = time.toMySqlTime();
      }
      this.validateStartEnd();
      this.calculateDuration();
    },
    calculateDuration() {
      let start = this.dateFromTime(this.form.start_at);
      let end = this.dateFromTime(this.form.end_at);
      let seconds = (end.getTime() - start.getTime()) / 1000;
      this.form.hours = (seconds / 60 / 60).toFixed(2);
      this.$buefy.toast.open({
        duration: 5000,
        message: `<b>Total hours</b> adjusted`,
        type: "is-warning"
      });
    },
    validateStartEnd() {
      if (this.form.start_at > this.form.end_at) {
        this.form.end_at = this.form.start_at;
        this.$buefy.toast.open({
          duration: 5000,
          message: `<b>End time</b> adjusted`,
          type: "is-warning"
        });
      }
    }
  }
};
</script>
