<template>
  <div>
    <input type="hidden" size="150" name="location" :value="json" />
    <b-autocomplete
      required
      :value="city"
      :data="rows"
      placeholder="e.g. Berlin"
      field="city.name"
      :loading="isFetching"
      :keep-first="true"
      @typing="typing"
      @select="$emit('input', $event)"
      icon="magnify"
    >
      <template slot="empty">
        <div v-if="!isFetching" class="content has-text-grey has-text-centered">
          <b-icon icon="emoticon-sad"></b-icon>
          <p>Nothing found, try a city close to you</p>
        </div>
        <div v-if="isFetching" class="content has-text-grey has-text-centered">
          <b-icon icon="timer-sand"></b-icon>
          <p>Loading..</p>
        </div>
      </template>
      <template slot-scope="props">
        <div class="has-text-weight-medium" v-html="props.option.city.name"></div>
        <p>{{ props.option.region.name }}, {{ props.option.country.name }}</p>
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
      isFetching: false
    };
  },

  computed: {
    json() {
      return JSON.stringify(this.value);
    },
    city() {
      if (this.value && this.value.city) {
        return this.value.city.name;
      } else {
        return "";
      }
    }
  },

  methods: {
    typing: function(text) {
      this.$emit("input", "");
      this.getAsyncData(text);
    },
    getAsyncData: window.debounce(function(name) {
      if (!name.length || name.length < 2) {
        this.rows = [];
        return;
      }
      this.isFetching = true;
      axios
        .get(`/api/search/location/${name}`)
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
