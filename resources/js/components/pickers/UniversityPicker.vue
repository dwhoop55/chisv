// v-model safe
<template>
  <div>
    <b-autocomplete
      required
      :value="universityName"
      :data="rows"
      :placeholder="'e.g. RWTH'"
      :field="'name'"
      :loading="isFetching"
      :keep-first="true"
      debounce-events="typing"
      v-debounce="typing"
      @select="select"
      icon="magnify"
    >
      <template slot="empty">
        <div v-if="!isFetching" class="content has-text-grey has-text-centered">
          <b-icon icon="emoticon-sad"></b-icon>
          <p>Nothing found, just type the name</p>
        </div>
        <div v-if="isFetching" class="content has-text-grey has-text-centered">
          <b-icon icon="timer-sand"></b-icon>
          <p>Loading..</p>
        </div>
      </template>
      <template slot-scope="props">
        <div class="has-text-weight-medium" v-html="props.option.name"></div>
        <p>{{ props.option.url }}</p>
      </template>
    </b-autocomplete>
  </div>
</template>

<script>
export default {
  props: ["value"],

  data() {
    return {
      rows: [],
      isFetching: false,
      internal: this.value
    };
  },

  computed: {
    universityName() {
      if (this.internal && this.internal.name) {
        return this.internal.name;
      } else if (this.value && this.value.name) {
        return this.value.name;
      }
    }
  },

  methods: {
    typing: function(text) {
      this.internal = { name: text };
      this.$emit("input", this.internal);
      this.getAsyncData(text);
    },
    select: function(event) {
      this.internal = event;
      this.$emit("input", event);
    },
    getAsyncData(name) {
      if (!name.length || name.length < 2) {
        this.rows = [];
        return;
      }
      this.isFetching = true;
      axios
        .get(`search/university/${name}`)
        .then(({ data }) => {
          this.rows = [];
          data.data.forEach(entry => this.rows.push(entry));
        })
        .catch(error => {
          this.rows = [];
          this.$notification.open({
            message: `Could not load University: ${error}`,
            type: "is-danger",
            indefinite: true
          });
        })
        .finally(() => {
          this.isFetching = false;
        });
    }
  }
};
</script>
