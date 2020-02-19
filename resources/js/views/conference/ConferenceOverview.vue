<template>
  <div>
    <div class="columns is-centered">
      <div class="column is-two-thirds">
        <enrollment-component @update="$emit('update',$event)" v-model="conference"></enrollment-component>
      </div>
    </div>

    <p class="content has-margin-t-1" v-dompurify-html="conference.description"></p>
  </div>
</template>

<script>
export default {
  props: ["conference"],
  model: {
    prop: "conference"
  }
};
</script>