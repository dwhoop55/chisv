<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Job: {{ jobName }}</p>
    </header>
    <section v-if="error" class="modal-card-body">
      <p>An error occured:</p>
      <strong>{{ error.response.data.message }}</strong>
    </section>
    <section v-else class="modal-card-body">
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
      <p>Result: {{job.result}}</p>
    </section>
    <footer class="modal-card-foot">
      <button @click="$parent.close()" class="button is-primary">Close</button>
    </footer>
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
            // Set a refresh in one second
            setTimeout(this.getJob, 1000);
          }
        })
        .catch(error => {
          this.error = error;
        })
        .finally(() => {
          this.isLoading = false;
        });
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
          return undefined;
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
    }
  }
};
</script>
