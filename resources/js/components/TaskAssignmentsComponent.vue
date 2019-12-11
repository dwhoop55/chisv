<template>
  <section>
    <div v-for="assignment in assignments" :key="assignment.id">
      <div :class="rowStyle(assignment.state)">
        <div class="columns is-mobile is-vcentered has-padding-7">
          <div
            class="column"
          >{{ assignment.user.lastname }}, {{ assignment.user.firstname }} (did {{ hours(assignment.user.hours_done) }})</div>
          <div class="column has-text-right is-narrow column-small">
            <b-button
              @click="adjustHours(assignment)"
              type="is-text"
            >{{ assignment.state.name == 'done' ? 'Got' : "Will get"}} {{ hours(assignment.hours) }} hours</b-button>
          </div>
          <div class="column has-text-right is-narrow column-small">{{ assignment.state.name }}</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["assignments"],
  model: {
    prop: "assignments",
    event: "input"
  },

  data() {
    return {};
  },

  methods: {
    adjustHours(assignment) {

    }
    hours(decimal) {
      return this.hoursFromTime(this.timeFromDecimal(decimal));
    },
    rowStyle(state) {
      return (
        "is-clipped " + this.stateType(state).replace("is-", "has-background-")
      );
    }
  }
};
</script>

<style scoped>
.column-small {
  width: 200px;
}
</style>
