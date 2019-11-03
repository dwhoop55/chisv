<template>
  <div>
    <b-field
      v-for="(field, index) in value.meta"
      :key="`field-${index}`"
      :label="field.description"
    >
      <div v-if="field.type=='boolean'">
        <b-numberinput @input="field.weight=$event" :value="field.weight"></b-numberinput>
      </div>
      <div v-else>This field cannot be quantified</div>
    </b-field>
  </div>
</template>

<script>
export default {
  props: ["value"]
};
</script>
