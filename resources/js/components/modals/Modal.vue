<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title"><slot name="title"></slot></p>
      <button
        v-if="showClose"
        type="button"
        class="delete"
        @click="$emit('close')"
      />
    </header>
    <section class="modal-card-body">
      <slot>Body</slot>
    </section>
    <footer v-if="showFooter" class="modal-card-foot">
      <slot name="footer"></slot>
      <button
        v-if="showClose"
        class="button"
        type="button"
        @click="$emit('close')"
      >
        Close
      </button>
    </footer>
  </div>
</template>

<script>
export default {
  name: "Modal",
  props: ["showClose", "showFooter"],
};
</script>
