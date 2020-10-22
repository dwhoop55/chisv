// v-model safe
<template>
  <div>
    <b-field :type="type" :message="message">
      <b-select
        expanded
        v-if="countries"
        @input="onCountryChange($event)"
        :value="country"
        placeholder="Select your country"
      >
        <option
          v-for="(country, index) in countries"
          :value="country"
          :key="index"
        >
          {{ country.name }}
        </option>
      </b-select>
    </b-field>

    <b-field>
      <b-autocomplete
        :disabled="!country"
        :value="city"
        :data="rows"
        placeholder="City (optional)"
        field="name"
        :loading="isLoading"
        keep-first
        open-on-focus
        v-debounce="load"
        debounce-events="typing"
        @select="onCityChange($event)"
        @input="onCityInput($event)"
        icon="magnify"
        clearable
      >
        <template slot="empty">
          <div
            v-if="!isLoading"
            class="content has-text-grey has-text-centered"
          >
            <b-icon icon="emoticon-sad"></b-icon>
            <p>Nothing found, try a city close to you or leave blank</p>
          </div>
          <div v-if="isLoading" class="content has-text-grey has-text-centered">
            <b-icon icon="timer-sand"></b-icon>
            <p>Loading..</p>
          </div>
        </template>
        <template slot-scope="props">
          <div
            class="has-text-weight-medium"
            v-html="props.option.city.name"
          ></div>
          <p>{{ props.option.region.name }}, {{ props.option.country.name }}</p>
        </template>
      </b-autocomplete>
    </b-field>
  </div>
</template>

<script>
import api from "@/api";
import { mapGetters } from "vuex";

export default {
  props: ["value", "type", "message"],

  data() {
    return {
      isLoading: false,
      rows: [],
    };
  },

  computed: {
    city() {
      return this.value?.city?.name || null;
    },
    country() {
      return this.value?.country || null;
    },
    ...mapGetters("defines", ["countries"]),
  },

  methods: {
    onCityInput(event) {
      if (event === "") {
        this.removeCity();
      }
    },
    removeCity() {
      let location = { ...this.value };
      location.city = null;
      location.region = null;
      this.$emit("input", location);
    },
    onCityChange(location) {
      this.$emit("input", location);
    },
    onCountryChange(country) {
      let location = { country, region: null, city: null };
      this.$emit("input", location);
    },
    load(name) {
      // if (!name || !name.length || name.length < 2) {
      //   this.rows = [];
      //   return;
      // }
      this.isLoading = true;
      api
        .getCityInCountry(this.value.country.id, name)
        .then(({ data }) => (this.rows = data))
        .catch((error) => (this.rows = []))
        .finally(() => (this.isLoading = false));
    },
  },
};
</script>
