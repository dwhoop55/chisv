<template>
  <div>
    <div
      :class="{ 'has-margin-t-7':true, 'is-block':showType, 'is-flex':!showType, }"
      :key="field.id"
      v-for="field in fields"
    >
      <div :class="{'has-margin-r-7':true , 'has-text-right':!showType}">{{ field.description }}</div>
      <div v-if="showValue">
        <p v-if="field.type === 'string'">
          <strong>{{ field.value }}</strong>
        </p>
        <p v-else-if="field.type === 'boolean'">
          <b-icon v-if="field.value==true" icon="checkbox-marked" type="is-success"></b-icon>
          <b-icon v-else icon="checkbox-blank-outline" type="is-danger"></b-icon>
        </p>
        <p v-else-if="field.type === 'integer'">
          <strong>{{ field.value }}</strong>
        </p>
      </div>
      <div v-if="showType">
        <b-icon v-if="field.type=='boolean'" class="is-vertical" icon="toggle-switch" />
        <b-icon v-if="field.type=='string'" icon="card-text" />
        <b-icon v-if="field.type=='integer'" icon="counter" />
        <i>&lt;{{ field.type }}&gt;</i>
        <i v-if="field.required">| required={{field.required}}</i>
        <i v-if="field.maxlength">| maxlength={{field.maxlength}}</i>
        <i v-if="field.value">| default={{field.value}}</i>
        <i v-if="field.weight">| weight={{field.weight}}</i>
        <i v-if="field.range">| range={{field.range}}</i>
      </div>
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