<template>
  <section>
    <div class="form-container">
      <div class="form-card">
        <div class="form-title">
          <h1>{{ title }}</h1>
        </div>

        <div class="form-content">
          <b-field grouped>
            <b-field label="Firstname" expanded>
              <b-input v-model="firstname" value></b-input>
            </b-field>

            <b-field label="Lastname" expanded>
              <b-input v-model="lastname" value></b-input>
            </b-field>
          </b-field>

          <b-field label="Email" :type="{ 'is-danger': emailMessage }" :message="emailMessage">
            <b-input type="email" v-model="email" maxlength="64"></b-input>
          </b-field>

          <b-field label="City of residence">
            <b-autocomplete
              :data="locResidence"
              placeholder="e.g. Aachen"
              field="city.name"
              :loading="locIsFetching"
              @typing="getAsyncData"
              @select="option => locSelected = option"
              icon="magnify"
            >
              <template slot="empty">No results found</template>
              <template slot-scope="props">
                <div>{{ props.option.city.name }}</div>
                <small>{{ props.option.region.name }}, {{ props.option.country.name }}</small>
              </template>
            </b-autocomplete>
          </b-field>
          <p
            class="help"
            v-if="locSelected"
          >{{ locSelected.region.name }}, {{ locSelected.country.name }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import debounce from "lodash/debounce";

export default {
  props: ["title"],
  data() {
    return {
      firstname: "",
      lastname: "",
      emailMessage: "",
      email: "",
      locResidence: [],
      locSelected: null,
      locIsFetching: false,
      locCityName: ""
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    getAsyncData: debounce(function(name) {
      if (!name.length) {
        this.locResidence = [];
        return;
      }
      this.locIsFetching = true;
      this.$http
        .get(`/api/city/search/${name}`)
        .then(({ data }) => {
          this.locResidence = [];
          console.log(data[0]);
          data.data.forEach(location => this.locResidence.push(location));
        })
        .catch(error => {
          this.locResidence = [];
          throw error;
        })
        .finally(() => {
          this.locIsFetching = false;
        });
    }, 500)
  }
};
</script>
