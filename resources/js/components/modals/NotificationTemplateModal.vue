<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Notification Templates</p>
    </header>
    <section class="modal-card-body">
      <b-notification
        v-if="cannotCreate"
        :closable="false"
        type="is-warning"
      >To add a template make sure the template has at least one element</b-notification>
      <b-field grouped group-multiline>
        <b-input
          :disabled="cannotCreate"
          expanded
          placeholder="Give the template a name"
          v-model="templateName"
        ></b-input>
        <b-button
          :disabled="cannotCreate"
          @click="createTemplate(templateName)"
          type="is-primary"
        >Add</b-button>
      </b-field>
      <p>Templates are visible to all chairs conference wide. Only group destinations will be saved.</p>
      <b-table
        ref="table"
        focusable
        @click="toggle($event)"
        detail-key="id"
        :opened-detailed="detailOpen"
        :selected.sync="selected"
        :default-sort="['year','desc']"
        detailed
        paginated
        per-page="15"
        :data="templates"
        striped
        :loading="isLoading"
        :mobile-cards="false"
      >
        <template slot-scope="props">
          <b-table-column field="id" label="ID" width="4" numeric sortable>{{ props.row.id }}</b-table-column>
          <b-table-column
            field="year"
            width="5"
            label="Year"
            searchable
            sortable
          >{{ props.row.year }}</b-table-column>
          <b-table-column field="name" label="Name" searchable sortable>{{ props.row.name }}</b-table-column>
          <b-table-column
            field="data.subject"
            label="Subject"
            searchable
            sortable
          >{{ props.row.data.subject }}</b-table-column>
          <b-table-column
            label="Destinations"
            searchable
            sortable
          >{{ formatDestinations(props.row.data.destinations) }}</b-table-column>
          <b-table-column
            width="5"
            field="conference.key"
            label="Conference"
            searchable
            sortable
          >{{ props.row.conference.key }}</b-table-column>
        </template>

        <template slot="empty">
          <section class="section">
            <div class="content has-text-grey has-text-centered">
              <p>
                <b-icon icon="emoticon-sad" size="is-large"></b-icon>
              </p>
              <p>No templates found</p>
            </div>
          </section>
        </template>
        <template slot="detail" slot-scope="props">
          {{ props.row.data.subject }}
          <notification-display
            :subject="props.row.data.subject"
            :greeting="props.row.data.greeting"
            :elements="props.row.data.elements"
            :salutation="props.row.data.salutation"
          />
        </template>
      </b-table>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-primary" type="button" @click="$parent.close()">Cancel</button>
      <button
        :disabled="!selected"
        class="button is-danger"
        type="button"
        @click="deleteTemplate(selected)"
      >Delete selected</button>
      <button
        :disabled="!selected"
        class="button is-success"
        type="button"
        @click="applyTemplate()"
      >Apply selected</button>
    </footer>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["conference", "template", "apply"],

  data() {
    return {
      isLoading: false,
      templates: [],
      templateName: "",
      selected: null,
      detailOpen: []
    };
  },

  created() {
    this.getTemplates();
    this.templateName =
      this.conference.key + "-" + new Date().toISOString().slice(0, 10);
  },

  computed: {
    cannotCreate() {
      return this.template.elements.length == 0;
    }
  },

  methods: {
    formatDestinations(destinations) {
      let dst = destinations.map(dst => {
        return dst.display;
      });
      return dst.join(", ");
    },
    applyTemplate() {
      this.apply(this.selected.data);
      this.$parent.close();
    },
    getTemplates() {
      this.isLoading = true;
      api
        .getNotificationTemplates()
        .then(({ data }) => {
          this.templates = data.map(template => {
            template.data = JSON.parse(template.data);
            return template;
          });
        })
        .catch(error => {
          this.showError(error);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    deleteTemplate(template) {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message: `Are you sure you want to
        <b>permanently delete</b> the notification template <i>${template.name}</i> ?
        <br/><br/>
        This action cannot be undone.`,
        confirmText: "Yes, delete this template",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => {
          this.isLoading = true;
          api
            .deleteNotificationTemplate(template.id)
            .then(({ data }) => {
              this.getTemplates();
            })
            .catch(error => {
              this.showError(error);
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    },
    createTemplate(name) {
      this.isLoading = true;
      api
        .createNotificationTemplate(name, this.template, this.conference)
        .then(({ data }) => {
          this.getTemplates();
        })
        .catch(error => {
          this.showError(error);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    toggle(row) {
      if (this.detailOpen.includes(row.id)) {
        this.detailOpen = [];
      } else {
        this.detailOpen = [row.id];
      }
    }
  }
};
</script>
