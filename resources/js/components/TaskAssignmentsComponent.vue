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
            {{ assignment.user.firstname }} {{ assignment.user.lastname }} (did {{ decimalFormat(assignment.user.hours_done) }})
            <a
              @click.prevent="remove(assignment)"
            >(remove)</a>
          </div>
          <div class="column has-text-right is-narrow column-small">
            <b-button
              @click="adjustHours(assignment)"
              class="has-text-dark"
              :type="stateType(assignment.state)"
            >{{ assignment.state.name == 'done' ? 'Got' : "Will get"}} {{ decimalFormat(assignment.hours) }} hours</b-button>
          </div>
          <div class="column has-text-right is-narrow column-small">
            <b-button
              expanded
              :type="stateType(assignment.state)"
              class="has-text-weight-bold has-text-dark"
              @click.prevent="cycleState(assignment)"
            >{{ assignment.state.name }}</b-button>
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
          // Since the user can be also assigned to other tasks but this one
          // we need to throw an event to be handled by the parent component
          // which has access to all the tasks. It will then take care
          // that every user model gets updated
          if (nextStateId == 43) {
            // done, add hours from the asignment
            this.$emit("updateHours", {
              userId: assignment.user.id,
              hours: parseFloat(assignment.hours)
            });
          } else if (nextStateId == 41) {
            // assigned, remove hours from assignment
            this.$emit("updateHours", {
              userId: assignment.user.id,
              hours: -parseFloat(assignment.hours)
            });
          }
        });
    },
    assign(sv) {
      this.isLoading = true;
      api
        .createAssignment(sv.id, this.task.id)
        .then(data => {
          this.$emit("reload");
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
                let currentAssignment = this.assignments[index];
                if (currentAssignment.id == assignment.id) {
                  this.$emit("updateHours", {
                    userId: currentAssignment.user.id,
                    hours: -currentAssignment.hours
                  });
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
        message: `Modify the hours the SV gets. You can use:<br/><li>Decimal like 2,5 or 1.25</li><li>Hours (HH:MM) like 1:15 or 02:30</li>`,
        inputAttrs: {
          placeholder: "Hours the SV will get",
          // Show correctly formatted input to help provide correct format
          value: parseFloat(assignment.hours).toFixed(2)
        },
        trapFocus: true,
        onConfirm: value => {
          this.isLoading = true;
          var newHours = assignment.hours;
          if (value.match(/\d{1,2}:\d{1,2}/g)) {
            // matches hours format
            // matches 11:23 or 1:15 but NOT 10:5
            newHours = parseFloat(
              this.decimalFormat(this.decimalFromTime(value))
            );
          } else if (value.match(/\d{1,}([,.]\d{1,})?/g)) {
            // matches decimal format
            // matches 1,5 or 10,99 or 1 or 1.40
            newHours = parseFloat(
              parseFloat(value.replace(",", ".")).toFixed(2)
            );
          } else {
            // unknown format
            this.$buefy.notification.open({
              duration: 5000,
              message: `Your input is not a valid number. Provide numeric (1.15 or 2 or 2,25) or time (01:15, 1:30)`,
              type: "is-danger",
              hasIcon: true
            });
          }

          if (newHours == assignment.hours) {
            console.log("No change, returning");
            return;
          }
          if (isNaN(newHours) || parseFloat(newHours) == 0.0) {
            this.$buefy.notification.open({
              duration: 5000,
              message: `Your input is not a valid number. (E.g. 2.25 or 5.75)`,
              type: "is-danger",
              hasIcon: true
            });
            return;
          }
          api
            .updateAssignment(assignment.id, { hours: newHours })
            .then(data => {
              // The backend updated the hours
              // But instead of reloading the entire page
              // we will only update the hours in the frontent

              // This will update the user model when the task is done
              // so that all places where the
              // user is show it will be shown consistently
              if (assignment.state.id == 43) {
                // done
                this.$emit("updateHours", {
                  userId: assignment.user.id,
                  // We subtract the new - old value so that we get
                  // something positive in case the hours increased
                  // or negative in case we reduced the hours.
                  // The parent handler will update all models
                  hours:
                    parseFloat(data.data.result.hours) -
                    parseFloat(assignment.hours)
                });
              }

              // This will make the row to show the correct hours for the
              // assignment
              assignment.hours = data.data.result.hours;
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
