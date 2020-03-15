<template>
  <div>
    <div class="columns is-centered">
      <div class="column is-two-thirds">
        <enrollment-component @update="$emit('update',$event)" v-model="conference"></enrollment-component>
      </div>
    </div>

    <VueShowdown class="section content" :markdown="description" />
  </div>
</template>

<script>
export default {
  props: ["conference"],

  computed: {
    description() {
      if (this.conference.description) {
        return this.conference.description;
      } else {
        return "#### No description yet..";
      }
    }
  }
};
</script>