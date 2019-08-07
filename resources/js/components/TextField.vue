<template>
  <div>
    <textarea class="is-hidden" v-model="inputText" :name="inputName" />
    <b-input v-model="inputText" :maxlength="maxlength" type="textarea" :placeholder="placeholder"></b-input>
  </div>
</template>

<script>
export default {
  name: "text-field",
  props: ["input-name", "placeholder", "text", "maxlength"],
  mounted() {
    this.inputText = this.text;
  },
  data() {
    return { inputText: "" };
  }
};
</script>
