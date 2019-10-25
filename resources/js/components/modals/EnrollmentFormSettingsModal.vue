<template>
  <div class="modal-card" style="width: auto">
    <header class="modal-card-head">
      <p class="modal-card-title">Lottery Weight Settings</p>
    </header>
    <section class="modal-card-body">
      <p>Changes are applied immediately</p>
      <enrollment-form-weight-settings v-model="value"></enrollment-form-weight-settings>
    </section>
    <footer class="modal-card-foot">
      <button class="button" type="button" @click="$parent.close()">Close</button>
    </footer>
  </div>
</template>

<script>
export default {
  props: ["value"]
};
</script>
