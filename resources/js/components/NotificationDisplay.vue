<template>
  <div class="content">
    <p v-if="!hideGreeting" class="subtitle">{{ getGreeting }}</p>
    <div v-for="(element, index) in elements" :key="index">
      <div v-if="element.type == 'markdown'">
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
    <VueShowdown v-if="salutation && !hideSalutation" :markdown="salutation" />
  </div>
</template>

<script>
export default {
  props: [
    "subject",
    "greeting",
    "salutation",
    "elements",
    "hideGreeting",
    "hideSalutation",
    "firstname"
  ],

  computed: {
    getGreeting() {
      if (this.greeting) {
        return this.greeting;
      } else if (this.firstname) {
        return `Hello ${firstname},`;
      } else {
        return "Hello {firstname},";
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
