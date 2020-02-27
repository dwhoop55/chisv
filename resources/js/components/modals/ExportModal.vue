<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ filename ? filename : "Export" }}</p>
    </header>
    <section class="modal-card-body">
      <b-field grouped>
        <b-field label="Name" expanded>
          <b-input v-model="name"></b-input>
        </b-field>
      </b-field>

      <b-field label="Format">
        <div class="block">
          <b-radio v-model="type" name="csv" native-value="csv">csv</b-radio>
        </div>
      </b-field>

      <b-field v-if="type == 'csv'" label="Delimiter">
        <b-input v-model="delimiter"></b-input>
      </b-field>

      <b-field
        v-if="type == 'csv'"
        :label="`Excel compability (Prepends 'SEP=${delimiter}' to the export)`"
      >
        <b-checkbox v-model="csvExcel">{{ csvExcel ? 'Yes' : 'No' }}</b-checkbox>
      </b-field>

      <b-field label="Encoding">
        <div class="block">
          <b-radio v-model="encoding" name="utf-8" native-value="utf-8">utf-8</b-radio>
          <b-radio v-model="encoding" name="ascii" native-value="ascii">ascii</b-radio>
        </div>
      </b-field>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Cancel</b-button>
      <download-csv
        @export-finished="$parent.close()"
        :data="data"
        :name="filename"
        :delimiter="delimiter"
        :encoding="encoding"
        :separator-excel="csvExcel"
      >
        <b-button type="is-success">Export</b-button>
      </download-csv>
    </section>
  </div>
</template>

<script>
export default {
  props: ["data", "suggestedName"],

  data() {
    return {
      name: "Export",
      type: "csv",
      delimiter: ",",
      csvExcel: false,
      encoding: "utf-8"
    };
  },

  created() {
    if (this.suggestedName) {
      this.name = this.suggestedName;
    }
  },

  computed: {
    filename() {
      return this.name + "." + this.type.toLowerCase();
    }
  }
};
</script>
