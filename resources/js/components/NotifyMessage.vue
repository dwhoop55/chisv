<template>
  <div>
    <p class="subtitle">{{ greeting }}</p>
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
  </div>
</template>

<script>
export default {
  props: ["subject", "greeting", "elements"]
};
</script>
