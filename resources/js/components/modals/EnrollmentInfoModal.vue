<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Enrollment Info for {{ conference.key.toUpperCase() }}</p>
    </header>
    <section class="modal-card-body">
      <enrollment-info-form v-model="enrollmentInfo" :disabled="true" :conference="conference"></enrollment-info-form>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-primary" type="button" @click="$parent.close()">Close</button>
    </footer>
  </div>
</template>

<script>
export default {
  props: ["enrollmentInfo", "conference"]
};
</script>
