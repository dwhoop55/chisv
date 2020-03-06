<template>
  <div>
    <p class="subtitle">{{ getGreeting }}</p>
    <div v-for="(element, index) in elements" :key="index">
      <div class="content" v-if="element.type == 'markdown'">
        <VueShowdown :markdown="element.data" />
      </div>
      <div v-else-if="element.type == 'action'">
        <b-field grouped position="is-centered">
          <a
            class="button is-primary has-margin-7"
            target="_blank"
            :href="element.data.url"
          >{{ element.data.caption }}</a>
        </b-field>
      </div>
    </div>
    <p>&nbsp;</p>
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
