<template>
  <div class="control">
    <b-taglist attached>
      <role-tag v-if="permission.role" :role="permission.role" :size="size" />
      <conference-tag
        v-if="permission.conference"
        :conference="permission.conference"
        :size="size"
      />
      <state-tag v-if="permission.state" :state="permission.state" :size="size" />
    </b-taglist>
  </div>
</template>

<script>
export default {
  props: ["permission", "size"]
};
</script>
