<template>
  <section>
    <p class="has-margin-b-3" v-if="value && value.header">
      {{ value.header }}
    </p>

    <div v-bind:key="key" v-for="(field, key) in value.meta">
      <div class="has-margin-b-7">
        <b-tooltip
          v-if="field.hint"
          multilined
          position="is-bottom"
          :label="field.hint"
        >
          <p>
            <b-icon size="is-small" icon="help-circle-outline"></b-icon>
            {{ field.description }}
          </p>
        </b-tooltip>
        <div v-else>
          {{ field.description }}
        </div>
      </div>

      <has-error
        class="notification is-danger"
        :form="value.vform"
        :field="key"
      ></has-error>
      <b-field class="has-margin-b-5">
        <b-switch
          v-if="field.type == 'boolean'"
          :disabled="disabled"
          class="has-margin-l-6"
          type="is-success"
          v-model="value.vform[key]"
          :required="field.required"
          >{{ value.vform[key] ? "Yes" : "No" }}</b-switch
        >

        <b-input
          v-else-if="field.type == 'string'"
          :type="field.maxlength > 100 ? 'textarea' : ''"
          :maxlength="field.maxlength"
          :disabled="disabled"
          class="has-margin-l-6"
          v-model="value.vform[key]"
          :required="field.required"
        ></b-input>

        <b-numberinput
          v-else-if="field.type == 'integer'"
          :min="field.range[0] !== undefined ? field.range[0] : 0"
          :max="field.range[1] !== undefined ? field.range[1] : 999"
          :controls="!disabled"
          :disabled="disabled"
          class="has-margin-l-6"
          v-model="value.vform[key]"
          :required="field.required"
        />
      </b-field>
    </div>
  </section>
</template>

<script>
export default {
  props: ["value", "disabled"],
};
</script>
