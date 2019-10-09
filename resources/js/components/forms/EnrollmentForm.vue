<template>
  <section>
    <p v-if="value.meta && value.meta.header">{{ value.meta.header }}</p>

    <div v-bind:key="key" v-for="(field, key) in value.meta">
      <b-tooltip v-if="field.hint" multilined position="is-bottom" :label="field.hint">
        <b-icon icon="information"></b-icon>&nbsp;
        <p class="has-text-weight-medium">{{ field.description }}</p>
      </b-tooltip>
      <div v-else class="has-text-weight-medium has-margin-b-7">{{ field.description }}</div>

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
          v-else-if="field.type == 'string' && field.maxlength < 100"
          :maxlength="field.maxlength"
          :disabled="disabled"
          class="has-margin-l-6"
          v-model="value.vform[key]"
          :required="field.required"
        ></b-input>

        <b-input
          v-else-if="field.type == 'string' && field.maxlength >= 100"
          type="textarea"
          @input="value.vform[key] = $event"
          :maxlength="field.maxlength"
          :disabled="disabled"
          class="has-margin-l-6"
          :required="field.required"
        >{{ value.vform[key] }}</b-input>
      </b-field>
    </div>

    <!-- <b-tooltip
      multilined
      position="is-bottom"
      label="If you get selected as a local volunteer
               you may be requested to do specific tasks that leverage 
               that characteristic, like finding restaurants, helping
               with the Information desk, help with PC meeting, and others."
    >
      <b-icon icon="information"></b-icon>&nbsp;
      <p
        class="has-text-weight-medium"
      >{{ `Are you local to where ${conference ? conference.key.toUpperCase() : 'the conference'} will be this year?` }}</p>
    </b-tooltip>
    <b-field class="has-margin-b-5">
      <b-switch
        :disabled="disabled"
        class="has-margin-l-3 has-margin-t-7"
        type="is-success"
        v-model="value.know_city"
      >{{ value.know_city ? 'Yes' : 'No' }}</b-switch>
    </b-field>

    <span class="has-text-weight-medium">
      Have you
      <b>attended</b> this conference before?
    </span>
    <b-field class="has-margin-b-5">
      <b-switch
        :disabled="disabled"
        class="has-margin-l-3 has-margin-t-7"
        type="is-success"
        v-model="value.attended_before"
      >{{ value.attended_before ? 'Yes' : 'No' }}</b-switch>
    </b-field>

    <span class="has-text-weight-medium">
      Have you been an
      <b>SV</b> at this conference before?
    </span>
    <b-field class="has-margin-b-5">
      <b-switch
        :disabled="disabled"
        class="has-margin-l-3 has-margin-t-7"
        type="is-success"
        v-model="value.sved_before"
      >{{ value.sved_before ? 'Yes' : 'No' }}</b-switch>
    </b-field>

    <b-tooltip
      multilined
      label="Choosing 'yes' will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs."
    >
      <b-icon icon="information"></b-icon>&nbsp;
      <p class="has-text-weight-medium">
        Do you need to apply for a travel visa in order to attend this conference?
        <br />(answer no if you are eligible for a VISA waiver program for the country of the conference)
      </p>
    </b-tooltip>
    <b-field class="has-margin-b-5">
      <b-switch
        :disabled="disabled"
        class="has-margin-l-3 has-margin-t-7"
        type="is-success"
        v-model="value.need_visa"
      >{{ value.need_visa ? 'Yes' : 'No' }}</b-switch>
    </b-field>

    <span class="has-text-weight-medium">Please explain why you want to be an SV at the conference.</span>
    <b-field class="has-margin-b-5">
      <b-input
        :disabled="disabled"
        maxlength="2000"
        type="textarea"
        class="has-margin-l-3 has-margin-t-7"
        v-model="value.why"
      ></b-input>
    </b-field>-->
  </section>
</template>

<script>
export default {
  props: ["value", "disabled"],

  data() {
    return {};
  },

  created() {
    console.log(this.value);
  }
};
</script>
