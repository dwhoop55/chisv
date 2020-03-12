<template>
  <div>
    <b-button :disabled="disabled" @click="showModal=true" type="is-primary">Form Weights</b-button>
    <b-modal @close="$emit('input', value)" :active.sync="showModal" has-modal-card trap-focus>
      <enrollment-form-settings-modal @input="$emit('input', value)" :value="value"></enrollment-form-settings-modal>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["value", "disabled"],

  data() {
    return {
      showModal: false
    };
  }
};
</script>
