<template>
  <b-tag rounded :size="size">
    <b-tooltip :label="'Go to ' + conference.name" multilined>
      <a :href="'/conference/' + conference.key">{{ conference.key.substring(0,20) }}</a>
    </b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["conference", "size"]
};
</script>
