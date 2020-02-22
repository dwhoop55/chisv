<template>
  <section>
    <b-field expanded>
      <b-input
        :placeholder="`E.g. firstname, lastname, email`"
        :value="search"
        @input="onSearch($event)"
      ></b-input>
    </b-field>

    <b-field expanded>
      <university-picker :required="false" @input="onUniversityChange($event)" :value="university" />
    </b-field>

    <b-table
      :data="data ? data.data : []"
      :loading="isLoading"
      paginated
      narrowed
      pagination-position="both"
      backend-pagination
      backend-sorting
      :total="data ? data.total : 0"
      :per-page="perPage"
      :current-page="page"
      @page-change="onPageChange"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
      @sort="onSort"
    >
      <template slot-scope="props">
        <b-table-column field="firstname" label="Firstname" sortable>
          <a :href="`/user/${props.row.id}/edit`">{{ props.row.firstname }}</a>
        </b-table-column>

        <b-table-column field="lastname" label="Lastname" sortable>
          <a :href="`/user/${props.row.id}/edit`">{{ props.row.lastname }}</a>
        </b-table-column>

        <b-table-column field="email" label="E-Mail" sortable>{{ props.row.email }}</b-table-column>

        <b-table-column
          field="university.name"
          label="University"
        >{{ props.row.university ? props.row.university.name : props.row.university_fallback }}</b-table-column>

        <b-table-column width="200" field="permissions" label="Permissions">
          <div class="field is-grouped is-grouped-multiline">
            <div class="control" :key="permission.id" v-for="permission in props.row.permissions">
              <permission-tag :permission="permission"></permission-tag>
            </div>
          </div>
        </b-table-column>
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

      <template slot="footer">
        <div class="has-text-right">
          <b-dropdown @change="onPerPageChange" :value="perPage" aria-role="list">
            <button class="button is-small" slot="trigger">
              <span>{{ perPage == 99999999999 ? 'All' : perPage }} per page</span>
              <b-icon icon="menu-down"></b-icon>
            </button>

            <b-dropdown-item value="10" aria-role="listitem">10 per page</b-dropdown-item>
            <b-dropdown-item value="30" aria-role="listitem">25 per page</b-dropdown-item>
            <b-dropdown-item value="50" aria-role="listitem">50 per page</b-dropdown-item>
            <b-dropdown-item value="100" aria-role="listitem">100 per page</b-dropdown-item>
            <b-dropdown-item value="99999999999" aria-role="listitem">All per page</b-dropdown-item>
          </b-dropdown>
        </div>
      </template>

      <template slot="top-left">
        <b-button type="is-primary" @click="getUsers()">Reload</b-button>
      </template>
    </b-table>
  </section>
</template>


<script>
export default {
  data() {
    return {
      data: this.$store.getters.userIndexData,
      isLoading: false,
      sortField: this.$store.getters.userIndexSortField,
      sortDirection: this.$store.getters.userIndexSortDirection,
      search: this.$store.getters.userIndexSearch,
      university: this.$store.getters.userIndexUniversity,
      page: this.$store.getters.userIndexPage,
      perPage: this.$store.getters.userIndexPerPage
    };
  },
  methods: {
    getUsers() {
      var params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortDirection}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `search=${this.search}`
      ];

      if (this.university && this.university.id) {
        params.push(`university_id=${this.university.id}`);
      } else if (this.university) {
        params.push(`university_fallback=${this.university.name}`);
      }
      params = params.join("&");

      this.isLoading = true;
      axios
        .get(`user?${params}`)
        .then(data => {
          this.data = data.data;
          this.$store.commit("USER_INDEX_DATA", data.data);
          this.isLoading = false;
        })
        .catch(error => {
          this.data = [];
          this.total = 0;
          this.isLoading = false;
          throw error;
        });
    },
    onUniversityChange(university) {
      this.$store.commit("USER_INDEX_UNIVERSITY", university);
      this.university = university;
      this.getUsers();
    },
    onPageChange(page) {
      this.$store.commit("USER_INDEX_PAGE", page);
      this.page = page;
      this.getUsers();
    },
    onPerPageChange(perPage) {
      this.$store.commit("USER_INDEX_PER_PAGE", perPage);
      this.perPage = perPage;
      this.getUsers();
    },
    onSort(field, direction) {
      this.sortField = field;
      this.sortDirection = direction;
      this.$store.commit("USER_INDEX_SORT_FIELD", field);
      this.$store.commit("USER_INDEX_SORT_DIRECTION", direction);
      this.getUsers();
    },
    onSearch(search) {
      this.$store.commit("USER_INDEX_SEARCH", search);
      this.search = search;
      this.getUsers();
    }
  },

  mounted() {
    if (!this.data) {
      this.getUsers();
    }
  }
};
</script>
