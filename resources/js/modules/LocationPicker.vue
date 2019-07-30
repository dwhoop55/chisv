<template>
  <div>
    <input type="hidden" name="location" :value="JSON.stringify(selectedRow)" />
    <b-autocomplete
      required
      :data="rows"
      :value="computeValue"
      :placeholder="'e.g. Berlin'"
      :field="'city.name'"
      :loading="isFetching"
      :keep-first="true"
      @typing="getAsyncData"
      @select="selectedRow=$event"
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
  props: ["selected"],
  data() {
    return {
      rows: [],
      isFetching: false,
      selectedRow: this.selected
    };
  },
  computed: {
    computeValue: function() {
      if (this.selectedRow) {
        return this.selectedRow.city.name || "";
      } else {
        return "";
      }
    }
  },
  methods: {
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
