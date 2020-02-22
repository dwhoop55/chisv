// v-model safe
<template>
  <div>
    <b-autocomplete
      required
      :value="city"
      :data="rows"
      placeholder="e.g. Berlin"
      field="city.name"
      :loading="isLoading"
      :keep-first="true"
      v-debounce="typing"
      debounce-events="typing"
      @select="$emit('input', $event)"
      icon="magnify"
    >
      <template slot="empty">
        <div v-if="!isLoading" class="content has-text-grey has-text-centered">
          <b-icon icon="emoticon-sad"></b-icon>
          <p>Nothing found, try a city close to you</p>
        </div>
        <div v-if="isLoading" class="content has-text-grey has-text-centered">
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
      isLoading: false
    };
  },

  computed: {
    city() {
      if (this.value && this.value.city) {
        return this.value.city.name;
      } else {
        return "";
      }
    }
  },

  methods: {
    typing(name) {
      this.$emit("input");
      this.load(name);
    },
    load(name) {
      if (!name || !name.length || name.length < 2) {
        this.rows = [];
        return;
      }
      this.isLoading = true;
      axios
        .get(`search/location/${name}`)
        .then(({ data }) => {
          this.rows = data.data;
        })
        .catch(error => {
          this.rows = [];
          throw error;
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  }
};
</script>
