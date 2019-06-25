<template>
  <b-field horizontal>
    <template slot="label">
      {{ title }}
      <b-tooltip position="is-right" :label="tooltip">
        <b-icon size="is-small" icon="help-circle-outline"></b-icon>
      </b-tooltip>
    </template>
    <b-autocomplete
      required
      :data="rows"
      :placeholder="placeholder"
      :field="field"
      :loading="isFetching"
      :keep-first="true"
      @typing="getAsyncData"
      @select="$emit('update:id', $event)"
      icon="magnify"
    >
      <template slot="empty">
        <div v-if="!isFetching" class="content has-text-grey has-text-centered">
          <b-icon icon="emoticon-sad"></b-icon>
          <p>{{ notFoundText }}</p>
        </div>
        <div v-if="isFetching" class="content has-text-grey has-text-centered">
          <b-icon icon="timer-sand"></b-icon>
          <p>Loading..</p>
        </div>
      </template>
      <template slot-scope="props">
        <div v-if="type=='university'">
          <div class="has-text-weight-medium" v-html="props.option.name"></div>
          <p>{{ props.option.url }}</p>
        </div>
        <div v-else-if="type=='city'">
          <div class="has-text-weight-medium" v-html="props.option.city.name"></div>
          <p>{{ props.option.region.name }}, {{ props.option.country.name }}</p>
        </div>
        <div v-else>
          <div>{{ props.option.name }}</div>
        </div>
      </template>
    </b-autocomplete>
  </b-field>
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
    "type",
    "tooltip"
  ],
  data() {
    return {
      rows: [],
      isFetching: false
    };
  },
  methods: {
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
    }, 250)
  }
};
</script>
