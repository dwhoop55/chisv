<template>
  <div>
    <input :name="inputName" class="is-hidden" :value="date.toMySqlDate()" />
    <b-datepicker
      v-model="date"
      mobile-native
      placeholder="Click to select..."
      icon="calendar-today"
    ></b-datepicker>
  </div>
</template>

<script>
export default {
  props: ["input-name", "value"],
  name: "day-picker",
  data() {
    return {
      date: !this.value
        ? new Date()
        : new Date(Date.parse(this.value.replace("-", "/", "g")))
    };
  }
};
</script>
