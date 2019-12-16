<template>
  <section>
    <div>
      <task-assignment-sv-picker
        @input="assign($event)"
        :conference="this.conference"
        :task="this.task"
      ></task-assignment-sv-picker>
    </div>
    <div v-for="assignment in assignments" :key="assignment.id">
      <div :class="rowStyle(assignment.state)">
        <div class="columns is-mobile is-vcentered has-padding-7">
          <div class="column column-small">
            {{ assignment.user.firstname }} {{ assignment.user.lastname }} (did {{ hours(assignment.user.hours_done) }})
            <a
              @click.prevent="remove(assignment)"
            >(remove)</a>
          </div>
          <div class="column has-text-right is-narrow column-small">
            <b-button
              @click="adjustHours(assignment)"
              type="is-text"
            >{{ assignment.state.name == 'done' ? 'Got' : "Will get"}} {{ hours(assignment.hours) }} hours</b-button>
          </div>
          <div class="column has-text-right is-narrow column-small">
            <a
              class="has-text-weight-bold"
              @click="cycleState(assignment)"
            >{{ assignment.state.name }}</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import api from "@/api.js";

export default {
  props: ["assignments", "conference", "task"],
  model: {
    prop: "assignments",
    event: "input"
  },

  data() {
    return {
      isLoading: true
    };
  },

  methods: {
    cycleState(assignment) {
      let nextStateId = this.nextCycleState(assignment.state);

      this.isLoading = true;
      api
        .updateAssignment(assignment.id, { state_id: nextStateId })
        .then(data => {
          assignment.state = data.data.result.state;
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: `An error occured: ${error.response.data.message}`,
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
          // Now we add/remove the hours in the frontend model to the user
          // so that is stays consistent
          // Without it would only show the correct hours on page reload
          if (nextStateId == 43) {
            // done
            assignment.user.hours_done += assignment.hours;
          } else if (nextStateId == 41) {
            // assigned
            assignment.user.hours_done -= assignment.hours;
          }
        });
    },
    assign(sv) {
      this.isLoading = true;
      api
        .createAssignment(sv.id, this.task.id)
        .then(data => {
          this.$emit("updated");
        })
        .catch(error => {
          this.$buefy.notification.open({
            duration: 5000,
            message: "An error occured. Is the SV already assigned?",
            type: "is-danger",
            hasIcon: true
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    remove(assignment) {
      this.$buefy.dialog.confirm({
        title: `Remove SV from task?`,
        message: `Are your sure you want to remove the SV from this task? You could later add the SV again.`,
        onConfirm: () => {
          this.isLoading = true;
          api
            .deleteAssignment(assignment.id)
            .then(data => {
              for (let index = 0; index < this.assignments.length; index++) {
                if (this.assignments[index].id == assignment.id) {
                  this.assignments.splice(index, 1);
                }
              }
            })
            .catch(error => {
              this.$buefy.notification.open({
                duration: 5000,
                message: `An error occured: ${error.response.data.message}`,
                type: "is-danger",
                hasIcon: true
              });
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    },
    adjustHours(assignment) {
      this.$buefy.dialog.prompt({
        message: `Modify the hours the SV gets`,
        inputAttrs: {
          placeholder: "Hours the SV will get",
          value: assignment.hours
        },
        trapFocus: true,
        onConfirm: value => {
          this.isLoading = true;
          api
            .updateAssignment(assignment.id, { hours: value })
            .then(data => {
              assignment.hours = value;
            })
            .catch(error => {
              this.$buefy.notification.open({
                duration: 5000,
                message: `An error occured: ${error.response.data.message}`,
                type: "is-danger",
                hasIcon: true
              });
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    },
    hours(decimal) {
      return this.hoursFromTime(this.timeFromDecimal(decimal));
    },
    rowStyle(state) {
      return (
        "is-clipped " + this.stateType(state).replace("is-", "has-background-")
      );
    },
    nextCycleState(state) {
      // We use this to cycle through the states an assignment can be in
      switch (state.id) {
        case 41: // assigned
        case 42: // checked-in
          return state.id + 1;
          break;
        case 43: // done
          return 41; // assigned
          break;
      }
    }
  }
};
</script>

<style scoped>
.column-small {
  width: 200px;
}
</style>
