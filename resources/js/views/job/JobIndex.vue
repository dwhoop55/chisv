<template>
  <section>
    <p>Showing up to 50 of the last jobs</p>
    <b-field grouped position="is-right">
      <b-button icon-left="refresh" @click="getJobs" type="is-primary">Reload</b-button>
    </b-field>
    <b-table
      style="cursor: pointer"
      hoverable
      @click="showDetail"
      narrowed
      paginated
      per-page="10"
      :loading="isLoading"
      :data="jobs"
      default-sort="start_at"
      default-sort-direction="desc"
    >
      <template slot="bottom-left">Total: {{ jobs.length }}</template>
      <template slot-scope="props">
        <b-table-column sortable field="id" label="ID">{{ props.row.id }}</b-table-column>
        <b-table-column sortable field="name" label="Name">{{ props.row.name }}</b-table-column>
        <b-table-column sortable field="handler" label="Action">{{ props.row.handler }}</b-table-column>
        <b-table-column sortable field="state.id" label="State">
          <state-tag :state="props.row.state" />
        </b-table-column>
        <b-table-column
          sortable
          field="start_at"
          label="Start At"
        >{{ props.row.start_at | moment('lll') }}</b-table-column>
        <b-table-column sortable field="ended_at" label="Ended At">
          <div v-if="props.row.ended_at">{{ props.row.ended_at | moment('lll') }}</div>
          <div v-else>Not ended yet</div>
          {{ props.row.ended_at | moment('lll') }}
        </b-table-column>
      </template>
    </b-table>
  </section>
</template>

<script>
import api from "@/api.js";
import auth from "@/auth.js";
import JobModalVue from "../../components/modals/JobModal.vue";

export default {
  data() {
    return {
      jobs: [],
      isLoading: true
    };
  },

  created() {
    this.getJobs();
  },

  methods: {
    showDetail(row) {
      let jobId = row.id;
      this.$buefy.modal.open({
        parent: this,
        props: { id: jobId },
        component: JobModalVue,
        hasModalCard: true
      });
    },
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
