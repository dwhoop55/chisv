<template>
  <b-tag :size="size" :type="roleType">
    <b-tooltip :label="role.description" multilined>{{ role.name }}</b-tooltip>
  </b-tag>
</template>

<script>
export default {
  props: ["role", "size"],

  computed: {
    roleType: function() {
      if (this.role.name) {
        switch (this.role.name) {
          case "sv":
            return "is-light";
            break;
          case "chair":
            return "is-dark";
            break;
          case "captain":
            return "is-primary";
            break;
        }
      }
    }
  }
};
</script>
