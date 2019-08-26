<template>
  <b-tag rounded :size="size" :type="type">
    <b-tooltip :type="type" :label="role.description" multilined>{{ role.name | capitalize }}</b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["role", "size"],

  computed: {
    type: function() {
      return this.roleType(this.role);
    }
  }
};
</script>
