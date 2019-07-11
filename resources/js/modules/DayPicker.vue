<template>
  <div>
    <input :name="inputName" class="3is-hidden" :value="date" />
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
  props: ["value", "inputName"],
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
