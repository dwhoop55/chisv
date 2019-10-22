<template>
  <section>
    <div v-if="enrollmentFormTemplates.length > 0">
      <p>Preview: {{ selectedEnrollmentFormTemplate.name }} ({{ selectedEnrollmentFormTemplate.id }})</p>
      <enrollment-form-summary
        class="box"
        :value="selectedEnrollmentFormTemplate"
        :showType="true"
        :showValue="false"
      ></enrollment-form-summary>
      <b-pagination
        @change="$emit('input', enrollmentFormTemplates[$event-1].id)"
        :total="enrollmentFormTemplates.length"
        :current="selectedEnrollmentFormTemplatePos+1"
        :per-page="1"
        order="is-centered"
        aria-next-label="Next form"
        aria-previous-label="Previous form"
        aria-page-label="Form"
        aria-current-label="Current form"
      ></b-pagination>
    </div>
    <div v-else>No enrollment form templates found, selected is {{ value }}</div>
  </section>
  <!-- <b-dropdown
    v-if="enrollmentFormTemplates.length > 0"
    :value="value"
    @input="$emit('input', $event)"
    aria-role="list"
  >
    <button class="button is-primary" type="button" slot="trigger">
      <template>{{ selectedEnrollmentFormTemplate.name }} ({{ selectedEnrollmentFormTemplate.id }})</template>
      <b-icon icon="menu-down"></b-icon>
    </button>

    <b-dropdown-item
      :value="form.id"
      v-for="form in enrollmentFormTemplates"
      :key="form.id"
      aria-role="listitem"
    >
      <template>
        {{ form.name }}
        <div class="box">
          <enrollment-form-summary
            :value="form"
            :showType="true"
            :showValue="false"
            :showMargin="false"
          ></enrollment-form-summary>
        </div>
      </template>
    </b-dropdown-item>
  </b-dropdown>-->
</template>

<script>
import api from "@/api.js";

export default {
  props: ["value"],

  data() {
    return {
      isLoading: true,
      enrollmentFormTemplates: []
    };
  },

  created() {
    this.getEnrollmentFormTemplates();
  },

  methods: {
    getEnrollmentFormTemplates() {
      api
        .getEnrollmentFormTemplates()
        .then(data => {
          this.enrollmentFormTemplates = data.data;
        })
        .catch(error => {
          this.$buefy.toast.open({
            duration: 5000,
            message: `Could not load enrollment form templates: ${error.message}`,
            type: "is-danger"
          });
        })
        .finally(() => {
          // this.isLoading = false;
        });
    }
  },

  computed: {
    selectedEnrollmentFormTemplate() {
      for (
        let index = 0;
        index < this.enrollmentFormTemplates.length;
        index++
      ) {
        if (this.enrollmentFormTemplates[index].id == this.value) {
          return this.enrollmentFormTemplates[index];
        }
      }
    },
    selectedEnrollmentFormTemplatePos() {
      for (
        let index = 0;
        index < this.enrollmentFormTemplates.length;
        index++
      ) {
        if (this.enrollmentFormTemplates[index].id == this.value) {
          return index;
        }
      }
    }
  }
};
</script>
