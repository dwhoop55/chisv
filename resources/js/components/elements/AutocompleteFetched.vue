<template>
  <div class="field">
    <b-field :label="title">
      <b-autocomplete
        :data="rows"
        :placeholder="placeholder"
        :field="field"
        :loading="isFetching"
        :keep-first="true"
        @typing="getAsyncData"
        @select="emitSelected"
        icon="magnify"
      >
        <template slot="empty">
          <div v-if="!isFetching" class="content has-text-grey has-text-centered">
            <b-icon icon="emoticon-sad"></b-icon>
            <p>{{ notFoundText }}</p>
          </div>
          <div v-if="isFetching" class="content has-text-grey has-text-centered">
            <b-icon icon="emoticon-loading"></b-icon>
            <p>Loading..</p>
          </div>
        </template>
        <template slot-scope="props">
          <div v-if="type=='university'">
            <div v-html="props.option.name"></div>
            <small>{{ props.option.url }}</small>
          </div>
          <div v-else-if="type=='city'">
            <div v-html="props.option.city.name"></div>
            <small>{{ props.option.region.name }}, {{ props.option.country.name }}</small>
          </div>
          <div v-else>
            <div>{{ props.option.name }}</div>
          </div>
        </template>
      </b-autocomplete>
    </b-field>
  </div>
</template>

<script>
import debounce from "lodash/debounce";

export default {
  name: "autocomplete-fetched",
  props: [
    "url",
    "title",
    "placeholder",
    "field",
    "notFoundText",
    "selectedFooter",
    "type"
  ],
  data() {
    return {
      rows: [],
      isFetching: false,
      selected: null
    };
  },
  methods: {
    emitSelected: function(option) {
      this.selected = option;
      this.$emit("selected", this.selected);
    },
    getAsyncData: debounce(function(name) {
      if (!name.length || name.length < 2) {
        this.rows = [];
        return;
      }
      this.isFetching = true;
      this.$http
        .get(`${this.url}${name}`)
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
    }, 500)
  }
};
</script>
