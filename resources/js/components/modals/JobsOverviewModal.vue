<template>
  <div>
    <b-modal has-modal-card :active.sync="$root.$data.showJobsOverview">
      <div class="modal-card" style="width: auto">
        <header class="modal-card-head">
          <p class="modal-card-title">Background Jobs</p>
        </header>
        <section class="modal-card-body">
          <b-button @click="getJobs()" type="is-primary">Refresh</b-button>
          <b-table v-if="jobs" :data="jobs">
            <template slot-scope="props">
              <b-table-column field="id" label="Id">{{ props.row.id }}</b-table-column>
              <b-table-column field="name" label="Name">{{ props.row.name }}</b-table-column>
              <b-table-column field="state.name" label="State">
                <b-tooltip
                  type="is-light"
                  :label="props.row.state.description"
                  multilined
                >{{ props.row.state.name }}</b-tooltip>
              </b-table-column>
              <b-table-column field="created_at" label="Started">
                <b-tooltip
                  type="is-light"
                  position="is-left"
                  :label="props.row.created_at | moment('lll') "
                  multilined
                >{{ $moment(props.row.created_at).fromNow() }}</b-tooltip>
              </b-table-column>
              <b-table-column field="ended_at" label="Ended">
                <b-tooltip
                  type="is-light"
                  position="is-left"
                  :label="props.row.ended_at | moment('lll') "
                  multilined
                >{{ $moment(props.row.ended_at).fromNow() }}</b-tooltip>
              </b-table-column>
            </template>
          </b-table>
        </section>
        <footer class="modal-card-foot">
          <button
            class="button is-primary"
            type="button"
            @click="$root.$data.showJobsOverview = false"
          >Close</button>
        </footer>
      </div>
    </b-modal>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  data() {
    return {
      jobs: null,
      isLoading: true
    };
  },

  methods: {
    getJobs() {
      this.isLoading = true;
      api
        .getJobs()
        .then(data => {
          this.jobs = data.data.data;
        })
        .catch(error => {})
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>
