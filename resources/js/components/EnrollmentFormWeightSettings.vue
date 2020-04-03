<template>
  <div>
    <b-field
      v-for="(field, index) in value.meta"
      :key="`field-${index}`"
      :label="`Weight for '${field.description}' - Value is ${field.type}${getRange(field)}`"
    >
      <div v-if="field.type=='boolean' || field.type=='integer'">
        <b-numberinput @input="field.weight=$event" :value="field.weight"></b-numberinput>
      </div>
      <div v-else>This field cannot be quantified</div>
    </b-field>
  </div>
</template>

<script>
export default {
  props: ["value"],

  methods: {
    getRange(field) {
      if (field.type == "boolean") {
        return " from interval [0,1]";
      } else if (field.type == "integer") {
        return ` from interval [${field.range[0]},${field.range[1]}]`;
      } else {
        return "";
      }
    }
  }
};
</script>
