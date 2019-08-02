<template>
  <div>
    <input type="hidden" size="150" name="university" :value="json" />
    <b-autocomplete
      required
      :value="universityName"
      :data="rows"
      :placeholder="'e.g. RWTH'"
      :field="'name'"
      :loading="isFetching"
      :keep-first="true"
      @typing="typing"
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
      internal: {}
    };
  },

  mounted() {
    this.internal = this.value;
  },

  computed: {
    universityName() {
      if (this.internal && this.internal.name) {
        return this.internal.name;
      }
    },
    json() {
      if (this.internal && this.internal.name) {
        return JSON.stringify(this.internal);
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
    getAsyncData: window.debounce(function(name) {
      if (!name.length || name.length < 2) {
        this.rows = [];
        return;
      }
      this.isFetching = true;
      axios
        .get(`/api/search/university/${name}`)
        .then(({ data }) => {
          this.rows = [];
          data.data.forEach(entry => this.rows.push(entry));
        })
        .catch(error => {
          this.rows = [];
          throw error;
        })
        .finally(() => {
          this.isFetching = false;
        });
    }, 250)
  }
};
</script>
