<template>
  <section>
    <p>Available types: &lt;boolean&gt;,&lt;string&gt;,&lt;integer&gt;</p>
    <p>Contact chisv admins for a customized form</p>
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
      this.isLoading = true;
      api
        .getEnrollmentFormTemplates()
        .then(data => (this.enrollmentFormTemplates = data.data))
        .finally(() => (this.isLoading = false));
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
