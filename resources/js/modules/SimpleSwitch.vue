<template>
  <div>
    <input type="checkbox" :name="inputName" class="is-hidden" v-model="checked" value="1" />
    <div class="field">
      <b-switch
        v-model="checked"
        type="is-success"
      >{{ this.checked ? this.enabledText : this.disabledText }}</b-switch>
    </div>
  </div>
</template>

<script>
export default {
  name: "simple-switch",
  props: ["input-name", "value", "enabledText", "disabledText"],
  created() {
    if (this.value) {
      this.checked = this.value;
    }
  },
  computed: {
    isChecked() {
      return this.checked;
    }
  },
  data() {
    return { checked: false };
  }
};
</script>
