<template>
  <div>
    <div class="has-margin-b-6" :key="field.id" v-for="field in fields">
      <p v-if="field.type === 'string'">
        {{ field.description }}
        <br />
        <strong>{{ field.value }}</strong>
      </p>
      <p v-else-if="field.type === 'boolean'">
        {{ field.description }}
        <b-icon v-if="field.value==true" icon="checkbox-marked" type="is-success"></b-icon>
        <b-icon v-else icon="checkbox-blank-outline" type="is-danger"></b-icon>
        <br />
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["value"],

  data() {
    return {};
  },

  computed: {
    fields() {
      return JSON.parse(this.value.body).fields;
    }
  }
};
</script>