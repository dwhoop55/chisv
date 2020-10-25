<template>
  <div>
    <b-field>
      <b-select
        v-model="value.country"
        :disabled="isLoading"
        expanded
        placeholder="Select your country"
        @input="countryChange($event)"
      >
        <option v-for="country in countries" :key="country.id" :value="country">
          {{ country.name }}
        </option>
      </b-select>
    </b-field>

    <b-field>
      <b-autocomplete
        :value="cityName"
        :data="cities"
        :disabled="!value.country"
        :loading="isLoading"
        debounce-events="typing"
        field="name"
        icon="magnify"
        open-on-focus
        placeholder="City (optional)"
        v-debounce="searchCity"
        clearable
        @input="cityInput($event)"
        @select="cityChange($event)"
        @typing="clearCity()"
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
          <div class="has-text-weight-medium" v-html="props.option.name"></div>
          <p>{{ props.option.region.name }}</p>
        </template>
      </b-autocomplete>
    </b-field>

    <b-field>
      <!-- <b-autocomplete
        :data="rows"
        :disabled="!country"
        :loading="isLoading"
        :value="city"
        clearable
        debounce-events="typing"
        field="name"
        icon="magnify"
        keep-first
        open-on-focus
        placeholder="City (optional)"
        v-debounce="load"
        @input="onCityInput($event)"
        @select="onCityChange($event)"
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
      </b-autocomplete> -->
    </b-field>
  </div>
</template>

<script>
import api from "@/api";
import { mapGetters } from "vuex";

export default {
  props: {
    value: {
      country: {
        id: Number,
        name: String,
      },
      region: {
        id: Number,
        name: String,
      },
      city: {
        id: Number,
        name: String,
      },
    },
  },

  data() {
    return {
      isLoading: false,
      cities: [],
    };
  },

  computed: {
    cityName() {
      return this.value.city?.name;
    },
    ...mapGetters("defines", ["countries"]),
  },

  methods: {
    cityInput(event) {
      console.log("cityInput", event);
      if (event === "") {
        console.log("cityInput: remove city");
        this.$emit("input", {
          country: this.value.country,
          region: null,
          city: null,
        });
      }
    },
    cityChange(city) {
      console.log("cityChange", city);
      if (city) {
        console.log("cityChange", {
          country: this.value.country,
          region: city.region,
          city: { id: city.id, name: city.name },
        });
        this.$emit("input", {
          country: this.value.country,
          region: city.region,
          city: { id: city.id, name: city.name },
        });
      }
    },
    countryChange(country) {
      console.log("countryChange", country);
      this.cities = [];
      this.clearCity(country);
    },
    clearCity(country) {
      this.$emit("input", {
        country: country || this.value.country,
        region: null,
        city: null,
      });
    },
    searchCity(text) {
      this.isLoading = true;
      this.cities = [];
      api
        .getCitiesInCountry(this.value.country.id, text)
        .then(({ data }) => (this.cities = data))
        .finally(() => (this.isLoading = false));
    },
  },
};
</script>
