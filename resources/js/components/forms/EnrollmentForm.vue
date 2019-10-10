<template>
  <section>
    <p class="has-margin-b-3" v-if="value && value.header">{{ value.header }}</p>

    <div v-bind:key="key" v-for="(field, key) in value.meta">
      <b-tooltip v-if="field.hint" multilined position="is-bottom" :label="field.hint">
        <b-icon icon="information"></b-icon>&nbsp;
        <p class="has-text-weight-medium">{{ field.description }}</p>
      </b-tooltip>
      <div v-else class="has-text-weight-medium has-margin-b-7">{{ field.description }}</div>

      <has-error class="notification is-danger" :form="value.vform" :field="key"></has-error>
      <b-field class="has-margin-b-5">
        <b-switch
          v-if="field.type == 'boolean'"
          :disabled="disabled"
          class="has-margin-l-6"
          type="is-success"
          v-model="value.vform[key]"
          :required="field.required"
        >{{ value.vform[key] ? 'Yes' : 'No' }}</b-switch>

        <b-input
          v-else-if="field.type == 'string' && field.maxlength <= 100"
          :maxlength="field.maxlength"
          :disabled="disabled"
          class="has-margin-l-6"
          v-model="value.vform[key]"
          :required="field.required"
        ></b-input>

        <b-input
          v-else-if="field.type == 'string' && field.maxlength > 100"
          type="textarea"
          @input="value.vform[key] = $event"
          :maxlength="field.maxlength"
          :disabled="disabled"
          class="has-margin-l-6"
          v-model="value.vform[key]"
          :required="field.required"
        ></b-input>
      </b-field>
    </div>
  </section>
</template>

<script>
export default {
  props: ["value", "disabled"],

  data() {
    return {};
  },

  created() {}
};
</script>
