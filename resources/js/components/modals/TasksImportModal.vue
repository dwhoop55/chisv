<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Task CSV Import</p>
    </header>
    <section class="modal-card-body">
      <b-steps type="is-dark" :has-navigation="false" destroy-on-hide v-model="currentStep">
        <b-step-item
          :clickable="false"
          :type="currentStep >= 1 ? 'is-success' : ''"
          label="Select columns"
        >
          <br />
          <b-field label="Method" />
          <b-field>
            <b-radio
              @input="onModeChange($event)"
              v-model="isModeCreate"
              :native-value="true"
            >Create: All uploaded tasks will create new tasks</b-radio>
          </b-field>
          <b-field>
            <b-radio @input="onModeChange($event)" v-model="isModeCreate" :native-value="false">
              Update: Match uploaded tasks with their id to existing tasks and update all given fields.
              <br />If an existing task cannot be matched by id (when its not in the data you uploaded) there will be no change to the task.
            </b-radio>
          </b-field>
          <a @click="showFaq()">Take a look at the FAQ for more info</a>
          <br />
          <br />
          <b-field label="Columns to import" />
          <b-field v-for="field in fields" :key="field">
            <b-checkbox
              :disabled="fieldDisabled(field)"
              v-model="activeFields"
              :native-value="field"
            >{{ field }}</b-checkbox>
          </b-field>
        </b-step-item>
        <b-step-item
          :clickable="false"
          :type="currentStep >= 2 ? 'is-success' : ''"
          label="File column maps"
        >
          <b-notification type="is-info" :closable="false">
            <p>
              When you get
              <b>SEP=</b> for mapping the file is prepended by
              <b>SEP=,</b>
              <br />Remove it in a text editor
            </p>
          </b-notification>
          <csv-import
            buttonClass="control button"
            loadBtnText="Set Mapping.."
            ref="import"
            :headers="true"
            v-model="csv"
            :map-fields="activeFields"
          >
            <template slot="thead">
              <tr>
                <th>What we need for the database:</th>
                <th>What the file has you selected:</th>
              </tr>
            </template>
          </csv-import>
        </b-step-item>
        <b-step-item
          :clickable="false"
          :type="currentStep >= 3 ? 'is-success' : ''"
          label="Preview"
        >
          <p>
            Here is a preview of the tasks you are about to upload.
            <b>
              Click the
              Upload
            </b> button at the bottom to start the upload.
          </p>
          <b-table
            pagination-position="both"
            per-page="20"
            paginated
            narrowed
            :data="csv"
            :columns="tableColumns"
          ></b-table>
        </b-step-item>
        <b-step-item :clickable="false" :type="currentStep >= 4 ? 'is-success' : ''" label="Upload">
          <b-loading :is-full-page="true" :active="true" />
        </b-step-item>
      </b-steps>
    </section>
    <section class="modal-card-foot">
      <b-button @click="close()">Cancel</b-button>
      <b-button :disabled="!canGoPrevious" icon-left="arrow-left" @click="currentStep--">Previous</b-button>
      <b-button
        v-if="currentStep != 4"
        :disabled="!canGoNext"
        icon-right="arrow-right"
        @click="nextStep()"
        :type="currentStep==2 ? 'is-success' : ''"
      >{{ currentStep==2 ? 'Upload' : 'Next' }}</b-button>
      <b-button v-else type="is-success" @click="close()">Finish</b-button>
    </section>
  </div>
</template>

<script>
import api from "@/api.js";
export default {
  props: ["conference", "updated"],

  data() {
    return {
      isLoading: false,
      isModeCreate: true,
      csv: null,
      fields: [
        "id",
        "name",
        "description",
        "location",
        "date",
        "start_at",
        "end_at",
        "priority",
        "slots",
        "hours"
      ],
      requiredFields: ["id", "name", "date", "start_at", "end_at", "slots"],
      activeFields: ["name", "date", "start_at", "end_at", "slots"],
      currentStep: 0,
      unregisterRouterGuard: null
    };
  },

  methods: {
    showFaq() {
      this.$parent.close();
      this.unregisterRouterGuard();
      this.$router.push({
        name: "faq",
        params: { id: 6 }
      });
    },

    fieldDisabled(field) {
      if (
        field == "id" ||
        (this.isModeCreate && this.requiredFields.includes(field))
      ) {
        return true;
      } else {
        return false;
      }
    },
    onModeChange(isModeCreate) {
      this.activeFields = this.fields;
      if (isModeCreate) {
        this.activeFields = this.activeFields.filter(item => item != "id");
      } else if (this.activeFields.indexOf("id") < 0) {
        this.activeFields.unshift("id");
      }
    },
    close() {
      this.$parent.close();
    },
    nextStep() {
      this.currentStep++;
      if (this.currentStep == 3) {
        // Upload
        api
          .importTasks(this.csv, this.conference.key)
          .then(data => {
            var jobId = data.data.result;
            console.log(`Job ${jobId} dispatched`);
            this.$parent.close();
            this.updated(jobId);
          })
          .finally(() => this.currentStep++);
      }
    }
  },

  computed: {
    tableColumns() {
      var columns = this.activeFields.map(field => {
        return {
          field: field,
          label: field,
          searchable: true,
          sortable: true
        };
      });

      return columns;
    },
    canGoNext() {
      if (this.currentStep >= 4 || (!this.csv && this.currentStep == 1)) {
        return false;
      } else {
        return true;
      }
    },
    canGoPrevious() {
      if (this.currentStep <= 0 || this.currentStep == 4) {
        return false;
      } else {
        return true;
      }
    }
  },

  created() {
    this.onModeChange(true);

    this.unregisterRouterGuard = this.$router.beforeEach((to, from, next) => {
      if (this.currentStep > 0) {
        this.currentStep--;
      } else {
        this.$parent.close();
      }
      next(false);
    });

    this.$once("hook:destroyed", () => {
      this.unregisterRouterGuard();
    });
  }
};
</script>
