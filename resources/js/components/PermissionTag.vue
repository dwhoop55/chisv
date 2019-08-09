<template>
  <div class="control">
    <b-taglist attached>
      <b-tag :size="size" :type="roleType">{{ permission.role.name }}</b-tag>
      <b-tag v-if="permission.conference" :size="size" type="is-light">
        <a
          :href="'/conference/' + permission.conference.key"
        >{{ permission.conference.key.substring(0,20) }}</a>
      </b-tag>
      <b-tag v-if="permission.state" :size="size" :type="stateType">{{ permission.state.name }}</b-tag>
    </b-taglist>
  </div>
</template>

<script>
export default {
  props: ["permission", "size"],

  computed: {
    roleType: function() {
      if (this.permission.role.name) {
        switch (this.permission.role.name) {
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
    },
    stateType: function() {
      if (this.permission.state) {
        switch (this.permission.state.name) {
          case "accepted":
            return "is-success";
            break;
          case "dropped":
            return "is-danger";
            break;
          case "enrolled":
            return "is-light";
            break;
          case "waitlisted":
            return "is-warning";
            break;
        }
      }
    }
  }
};
</script>
