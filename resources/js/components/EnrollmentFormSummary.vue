<template>
  <div>
    <div
      :class="{ 'is-block' : showType, 'is-flex' : !showType }"
      :key="field.id"
      v-for="field in fields"
    >
      {{ field.description }}
      <div v-if="showValue">
        <p v-if="field.type === 'string'">
          <strong>{{ field.value }}</strong>
        </p>
        <p v-else-if="field.type === 'boolean'">
          <b-icon v-if="field.value==true" icon="checkbox-marked" type="is-success"></b-icon>
          <b-icon v-else icon="checkbox-blank-outline" type="is-danger"></b-icon>
        </p>
        <p></p>
      </div>
      <div v-if="showType">
        <i>&lt;{{ field.type }}&gt;</i>
        <i v-if="field.required != undefined">| required={{field.required}}</i>
        <i v-if="field.maxlength != undefined">| maxlength={{field.maxlength}}</i>
        <i v-if="field.value != undefined">| default={{field.value}}</i>
        <i v-if="field.weight != undefined">| weight={{field.weight}}</i>
      </div>
      <br />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Object
    },
    showType: {
      type: Boolean,
      default: false
    },
    showValue: {
      type: Boolean,
      default: true
    }
  },

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