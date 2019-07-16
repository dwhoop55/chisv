<template>
  <section>
    <input class="is-hidden" :name="inputName" :value="selectedId" />
    <b-autocomplete
      v-model="name"
      :data="filteredDataArray"
      :keep-first="true"
      :open-on-focus="true"
      placeholder="e.g. Europe/Berlin"
      icon="magnify"
      field="name"
      @select="option => selected = option"
    >
      <template slot="empty">No results found</template>
    </b-autocomplete>
  </section>
</template>

<script>
export default {
  name: "timezone-picker",
  props: ["inputName", "timezones", "id"],
  data() {
    return {
      name: "",
      selected: null
    };
  },
  created() {
    if (this.id) {
      this.selected = this.timezones[this.id - 1];
      this.name = this.selected.name;
    }
  },
  computed: {
    selectedId() {
      return this.selected ? this.selected.id : null;
    },
    filteredDataArray() {
      return this.timezones.filter(timezone => {
        return (
          timezone.name
            .toString()
            .toLowerCase()
            .indexOf(this.name.toLowerCase()) >= 0
        );
      });
    }
  }
};
</script>
