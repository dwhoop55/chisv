<template>
  <div>
    <p class="subtitle">{{ getGreeting }}</p>
    <div v-for="(element, index) in elements" :key="index">
      <p class="has-margin-b-7" v-if="element.type == 'text'">{{ element.data }}</p>
      <p
        v-else-if="element.type == 'title'"
        class="subtitle has-text-weight-bold has-margin-t-5 has-margin-b-7"
      >{{ element.data }}</p>
      <div v-else-if="element.type == 'action'">
        <a class="button" target="_blank" :href="element.data.url">{{ element.data.caption }}</a>
      </div>
    </div>
    <p v-html="getSalutation"></p>
  </div>
</template>

<script>
export default {
  props: ["subject", "greeting", "salutation", "elements"],

  computed: {
    getSalutation() {
      if (this.salutation) {
        return this.salutation.replace("\n", "<br/>");
      } else {
        return "Regards,<br/>chisv";
      }
    },
    getGreeting() {
      if (this.greeting) {
        return this.greeting;
      } else {
        return "Hello!";
      }
    },
    getSubject() {
      if (this.subject) {
        return this.subject;
      } else {
        return "Announcement";
      }
    }
  }
};
</script>
