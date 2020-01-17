<template>
  <div class="modal-card" style="min-width:300px; min-height:200px">
    <header class="modal-card-head">
      <p class="modal-card-title">Job: {{ jobName }}</p>
    </header>
    <section v-if="error" class="modal-card-body">
      <p>An error occured:</p>
      <strong>{{ error.response.data.message }}</strong>
    </section>
    <section v-else-if="job" class="modal-card-body">
      <b-progress
        :show-value="true"
        :type="stateType(job.state)"
        :value="valueForProgress"
        format="percent"
        size="is-medium"
      ></b-progress>
      <p>Handler: {{ job.handler.replace("App\\Jobs\\", '') }}</p>
      <p>
        Status:
        <state-tag :state="job.state" size="is-normal" />
      </p>
      <p>Id: {{ job.id }}</p>
      <p>Start at: {{ job.start_at | moment('lll') }}</p>
      <p v-if="job.ended_at">Ended at: {{ job.ended_at | moment('lll') }}</p>
      <p v-else>Job did not end running</p>
      <br />
      <p>
        <strong>Result</strong>
        <br />
        <span v-html="formattedJobResult"></span>
      </p>
    </section>
    <section v-else class="modal-card-body">
      <p>Job view is loading ..</p>
      <b-loading :active="isLoading" :is-full-page="false"></b-loading>
    </section>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["id"],

  created() {
    this.getJob();
  },

  methods: {
    getJob() {
      this.isLoading = true;
      this.error = null;
      api
        .getJob(this.id)
        .then(data => {
          this.job = data.data;

          // When the modal is shown and the state is
          // either planned or processing
          // schedule a timeout to refresh the data
          if (
            this.$parent.isActive &&
            (this.job.state.name == "planned" ||
              this.job.state.name == "processing")
          ) {
            // Set a refresh in 500ms
            setTimeout(this.getJob, 500);
          }
        })
        .catch(error => {
          this.error = error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    getProgressForProcessingState() {
      if (this.job && this.job.progress) {
        return parseInt(this.job.progress);
      } else {
        return undefined;
      }
    }
  },

  data() {
    return {
      job: null,
      isLoading: true,
      error: null,
      active: false
    };
  },

  computed: {
    valueForProgress() {
      switch (this.job.state.name) {
        case "planned":
          return 0;
          break;
        case "processing":
          return this.getProgressForProcessingState();
          break;
        case "successful":
          return 100;
          break;
        case "failed":
          return 100;
          break;
        default:
          return undefined;
          break;
      }
    },

    jobName() {
      if (this.job && this.job.name) {
        return this.job.name;
      } else {
        return "Unnamed job";
      }
    },
    formattedJobResult() {
      let r = JSON.parse(this.job.result);

      if (this.job.state.name == "successful") {
        switch (this.job.handler) {
          case "App\\Jobs\\DeleteAllAssignments":
            return `${r.deleted} assignments have been deleted`;
            break;
          case "App\\Jobs\\Auction":
            var $msg = `Created assignments: ${r.created_assignments}<br>
                    Tasks which could not be filled: ${r.tasks_free_slots.length}<br>`;
            r.tasks_free_slots.forEach(task => {
              $msg += `<li><b>${task.name}</b> ${this.hoursFromTime(
                task.start_at
              )}–${this.hoursFromTime(task.end_at)}</li>`;
            });
            return $msg;
            break;
          case "App\\Jobs\\Lottery":
            return `<ul>
                    <li><i>enrolled</i> SVs processed: ${r.processed}</li>
                    <li><i>accepted</i>: ${r.accepted}</li>
                    <li><i>waitlisted</i>: ${r.waitlisted}</li>
                    <li>Still on the waitlist: ${r.still_waitlisted}</li>
                  </ul>`;
            break;
          case "App\\Jobs\\ResetToEnrolled":
            return `${r.reset} SVs have been reset to state <i>enrolled</i>`;
            break;

          default:
            return this.job.result;
            break;
        }
      } else {
        return JSON.parse(this.job.result);
      }
    }
  }
};
</script>
