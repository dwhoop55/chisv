<template>
  <b-tag rounded :size="size" type="is-light">
    <b-tooltip type="is-light" :label="'Go to ' + conference.name" multilined>
      <router-link
        :to="{name: 'conference', params: {key: conference.key}}"
      >{{ conference.key.substring(0,20) }}</router-link>
    </b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["conference", "size"]
};
</script>
