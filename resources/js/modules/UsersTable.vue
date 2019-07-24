<template>
  <section>
    <b-field grouped group-multiline>
      <b-select @input="loadAsyncData" v-model="perPage">
        <option value="5">5 per page</option>
        <option value="10">10 per page</option>
        <option value="15">15 per page</option>
        <option value="25">25 per page</option>
        <option value="50">50 per page</option>
        <option value="75">75 per page</option>
        <option value="100">100 per page</option>
      </b-select>
    </b-field>

    <b-table
      :data="data"
      :loading="loading"
      paginated
      backend-pagination
      backend-sorting
      :total="total"
      :per-page="perPage"
      @click="goTo(`/user/${$event.id}`)"
      @page-change="onPageChange"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
      :default-sort-direction="defaultSortOrder"
      :default-sort="[sortField, sortOrder]"
      @sort="onSort"
    >
      <template slot-scope="props">
        <b-table-column
          class="is-clickable"
          field="firstname"
          label="Firstname"
          sortable
        >{{ props.row.firstname }}</b-table-column>
        <b-table-column
          class="is-clickable"
          field="lastname"
          label="Lastname"
          sortable
        >{{ props.row.lastname }}</b-table-column>
        <b-table-column field="email" label="E-Mail" sortable>{{ props.row.email }}</b-table-column>
        <b-table-column
          field="university.name"
          label="University"
        >{{ props.row.university.name ? props.row.university.name : props.row.university_fallback }}</b-table-column>
      </template>

      <template slot="empty">
        <section class="section">
          <div class="content has-text-grey has-text-centered">
            <p>
              <b-icon icon="emoticon-sad" size="is-large"></b-icon>
            </p>
            <p>Nothing here.</p>
          </div>
        </section>
      </template>
    </b-table>
  </section>
</template>


<script>
export default {
  data() {
    return {
      data: [],
      total: 0,
      loading: false,
      sortField: "firstname",
      sortOrder: "asc",
      defaultSortOrder: "asc",
      page: 1,
      perPage: 5
    };
  },
  methods: {
    /*
     * Load async data
     */
    loadAsyncData() {
      const params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortOrder}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`
      ].join("&");

      this.loading = true;
      axios
        .get(`/api/user?${params}`)
        .then(({ data }) => {
          this.data = [];
          this.total = data.meta.total;
          data.data.forEach(user => {
            // Change user infos here
            this.data.push(user);
          });
          this.loading = false;
        })
        .catch(error => {
          this.data = [];
          this.total = 0;
          this.loading = false;
          throw error;
        });
    },
    /*
     * Handle page-change event
     */
    onPageChange(page) {
      this.page = page;
      this.loadAsyncData();
    },
    /*
     * Handle sort event
     */
    onSort(field, order) {
      this.sortField = field;
      this.sortOrder = order;
      this.loadAsyncData();
    }
  },
  filters: {
    /**
     * Filter to truncate string, accepts a length parameter
     */
    truncate(value, length) {
      return value.length > length ? value.substr(0, length) + "..." : value;
    }
  },
  mounted() {
    this.loadAsyncData();
  }
};
</script>
