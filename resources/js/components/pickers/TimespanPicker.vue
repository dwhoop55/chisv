<template>
  <b-dropdown @active-change="$emit('active-change', $event);" append-to-body trap-focus>
    <div slot="trigger" role="button">
      <div class="control is-clearfix">
        <input
          type="text"
          autocomplete="off"
          :placeholder="placeholder"
          readonly
          class="input"
          :value="formatted"
        />
      </div>
    </div>
    <b-dropdown-item aria-role="menu-item" :focusable="false" custom>
      <b-field label="Start" label-position="inside">
        <b-timepicker
          @input="set(0, $event)"
          :incrementMinutes="incrementMinutes"
          :incrementHours="incrementHours"
          :value="getDate(0)"
          :hour-format="hourFormat"
          inline
        >
          <template>
            <b-button size="is-small" @click="set(0, null)">
              <span>Clear</span>
            </b-button>
          </template>
        </b-timepicker>
      </b-field>
      <b-field label="End" label-position="inside">
        <b-timepicker
          @input="set(1, $event)"
          :incrementMinutes="incrementMinutes"
          :incrementHours="incrementHours"
          :value="getDate(1)"
          :hour-format="hourFormat"
          inline
        >
          <template>
            <b-button size="is-small" @click="set(1, null)">
              <span>Clear</span>
            </b-button>
          </template>
        </b-timepicker>
      </b-field>
    </b-dropdown-item>
  </b-dropdown>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["incrementMinutes", "incrementHours", "value", "placeholder"],

  methods: {
    getDate(pos) {
      if (this.value && this.value[pos]) {
        // console.log("GETDATE", this.dateFromMySql(this.value[pos]));
        return this.dateFromMySql(this.value[pos]);
      } else if (pos === 0) {
        return this.$moment()
          .startOf("day")
          .toDate();
      } else if (pos === 1) {
        return this.$moment()
          .startOf("day")
          .add(1, "days")
          .toDate();
      } else {
        console.error("TimespanPicker:getDate|else", pos, this.value);
      }
    },
    get(pos) {
      if (this.value && this.value[pos]) {
        return this.value[pos];
      } else {
        return null;
      }
    },
    set(pos, date) {
      var interval = [this.get(0), this.get(1)];
      interval[pos] = date ? date.toMySqlTime() : null;
      this.$emit("input", interval);
      //   console.log("SET", interval);
    }
  },

  computed: {
    hourFormat() {
      return this.localeIsAmPm() ? "12" : "24";
    },
    formatted() {
      if (!this.value || (!this.value[0] && !this.value[1])) {
        return;
      }
      var start = this.$moment()
        .startOf("day")
        .format("LT");
      var end = this.$moment()
        .endOf("day")
        .format("LT");
      if (this.value && this.value[0]) {
        start = this.$moment(this.dateFromMySql(this.value[0])).format("LT");
        // console.log(
        //   "FORMAT",
        //   0,
        //   this.$moment(this.dateFromMySql(this.value[0])).format("LT")
        // );
      }
      if (this.value && this.value[1]) {
        end = this.$moment(this.dateFromMySql(this.value[1])).format("LT");
        // console.log(
        //   "FORMAT",
        //   1,
        //   this.$moment(this.dateFromMySql(this.value[1])).format("LT")
        // );
      }

      return `${start} - ${end}`;
    }
  }
};
</script>