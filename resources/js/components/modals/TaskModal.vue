<template>
  <div class="modal-card" style="width: 1000px; max-width:100%">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ task.name }}</p>
    </header>
    <section class="modal-card-body">
      <b-field grouped>
        <b-field
          expanded
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

      <b-field grouped group-multiline position="is-centered">
        <b-field
          :type="{ 'is-danger': form.errors.has('date') }"
          :message="form.errors.get('date')"
          label="Day"
          label-position="on-border"
        >
          <b-datepicker
            inline
            v-model="form.date"
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
        <b-field horizontal grouped>
          <b-field label-position="on-border" label="Start time">
            <b-timepicker
              @input="validateStartEnd();calculateDuration()"
              v-model="form.start_at"
              inline
            ></b-timepicker>
          </b-field>
          <b-field label-position="on-border" label="End time">
            <b-timepicker
              @input="validateStartEnd();calculateDuration()"
              v-model="form.end_at"
              inline
            ></b-timepicker>
          </b-field>
          <b-field label-position="on-border" label="Duration (HH:MM)">
            <b-timepicker v-model="form.hours" inline>
              <button class="button is-primary" @click="calculateDuration()">
                <b-icon icon="clock"></b-icon>
                <span>Reset</span>
              </button>
            </b-timepicker>
          </b-field>
        </b-field>
      </b-field>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Cancel</b-button>
      <b-button type="is-success">Apply</b-button>
    </section>
  </div>
</template>

<script>
import api from "@/api.js";
import { Form } from "vform";

export default {
  props: ["task", "calendarEvents"],
  data() {
    return {
      form: new Form({
        name: this.task.name,
        description: this.task.description,
        location: this.task.location,
        date: new Date(this.task.date),
        start_at: new Date(`1970-01-01 ${this.task.start_at}`),
        end_at: new Date(`1970-01-01 ${this.task.end_at}`),
        priority: this.task.priority,
        slots: this.task.slots,
        hours: new Date(`1970-01-01 ${this.timeFromDecimal(this.task.hours)}`)
      }),
      isLoading: true
    };
  },

  methods: {
    calculateDuration() {
      let seconds =
        (this.form.end_at.getTime() - this.form.start_at.getTime()) / 1000;
      var duration = new Date("1970-01-01 00:00:00");
      duration.setSeconds(duration.getSeconds() + seconds);
      this.form.hours = duration;
      this.$buefy.toast.open({
        duration: 5000,
        position: "is-bottom",
        message: `<b>Duration</b> adjusted`,
        type: "is-warning"
      });
    },
    validateStartEnd() {
      if (this.form.start_at > this.form.end_at) {
        this.form.end_at = this.form.start_at;
        this.$buefy.toast.open({
          duration: 5000,
          position: "is-bottom",
          message: `<b>End time</b> adjusted`,
          type: "is-warning"
        });
      }
    }
  }
};
</script>
