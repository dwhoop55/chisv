<template>
  <section>
    <b-field grouped position="is-right">
      <b-button :disabled="isLoading" icon-left="refresh" @click="getJobs" type="is-primary">Reload</b-button>
    </b-field>
    <b-table
      style="cursor: pointer"
      hoverable
      @click="showDetail"
      narrowed
      paginated
      per-page="50"
      :loading="isLoading"
      :data="jobs"
      default-sort="start_at"
      default-sort-direction="desc"
    >
      <template slot="bottom-left">Showing up to {{ take }} of all {{ total }} jobs</template>
      <template slot-scope="props">
        <b-table-column sortable field="id" label="ID">{{ props.row.id ? props.row.id : 'n/a' }}</b-table-column>
        <b-table-column
          sortable
          field="name"
          label="Name"
        >{{ props.row.name ? props.row.name : props.row.name.to }}</b-table-column>
        <b-table-column
          sortable
          field="handler"
          label="Handler"
        >{{ props.row.handler.replace("App\\", '') }}</b-table-column>
        <b-table-column sortable field="state.id" label="State">
          <b-tag
            v-if="props.row.attempts >=0"
            rounded
            type="is-white"
          >Attempt {{ props.row.attempts+1 }}</b-tag>
          <state-tag v-else :state="props.row.state">
            <span v-if="props.row.progress">{{ props.row.progress }}%</span>
          </state-tag>
        </b-table-column>
        <b-table-column
          sortable
          field="start_at"
          label="Start At"
        >{{ momentize(props.row.start_at, {format:'lll', fromTz: 'UTC'}) }}</b-table-column>
        <b-table-column sortable field="ended_at" label="Ended At">
          <div
            v-if="props.row.ended_at"
          >{{ momentize(props.row.ended_at, {format:'lll', fromTz: 'UTC'}) }}</div>
          <div v-else>Not ended yet</div>
        </b-table-column>
      </template>
    </b-table>
  </section>
</template>

<script>
import api from "@/api.js";
import JobModalVue from "@/components/modals/JobModal.vue";

export default {
  data() {
    return {
      jobs: [],
      total: null,
      take: null,
      isLoading: true,
      timer: null,
      timerLeft: 0
    };
  },

  created() {
    this.getJobs();
    this.autoRefresh();
  },

  beforeDestroy() {
    clearInterval(this.timer);
  },

  methods: {
    autoRefresh() {
      this.timer = setTimeout(this.autoRefresh, 10000);
      this.getJobs(false);
    },
    showDetail(row) {
      if (row.type == "job") {
        let jobId = row.id;
        this.$buefy.modal.open({
          parent: this,
          props: { id: jobId },
          component: JobModalVue,
          hasModalCard: true,
          onCancel: () => {
            this.getJobs();
          }
        });
      } else if (row.type == "queue") {
        this.$buefy.dialog.alert({
          title: `Job: ${row.handler.replace("App\\", "")}`,
          message:
            "This is a queued job. It has no further information and vanished when processed.\
            You can ofter see these queued jobs with notifications (e.g. emails) and scheduled tasks.\
            <br><br>When a queued job fails it will reschedule itself after some delay.",
          type: "is-primary",
          hasIcon: true,
          icon: "clock"
        });
      }
    },
    getJobs(showLoading = true) {
      if (showLoading) this.isLoading = true;
      api
        .getJobs()
        .then(({ data }) => {
          this.jobs = data.data;
          this.total = data.total;
          this.take = data.take;
        })
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>
