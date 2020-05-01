<template>
  <div class="modal-card" style="max-width:100%">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ notes.length }} Note{{ notes.length>1 ? 's' :'' }}</p>
    </header>
    <section class="modal-card-body">
      <div class="box" v-for="note in sortedNotes" :key="note.id">
        <p class="is-size-5">{{ note.text }}</p>
        <p class="is-size-6">
          <span
            v-if="note.creator"
          >Posted by {{ note.creator.firstname }} {{ note.creator.lastname }}</span>
          <br />
          {{ momentize(note.created_at, {fromNow: true, fromTz: 'UTC'}) }}
          ({{ momentize(note.created_at, {format: 'l LT', fromTz: 'UTC', toTz}) }} {{ toTz }})
        </p>
      </div>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Close</b-button>
    </section>
  </div>
</template>

<script>
export default {
  name: "NotesModal",
  props: ["notes"],

  computed: {
    sortedNotes() {
      return this.notes.sort((a, b) => {
        return (
          this.dateFromMySql(b.created_at) - this.dateFromMySql(a.created_at)
        );
      });
    },
    toTz() {
      return this.$moment.tz.guess();
    }
  }
};
</script>
