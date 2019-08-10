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
        <option value="9999999">All</option>
      </b-select>

      <!-- This will have the backend to be able to sort for foreign key'ed objected -->
      <!-- <b-select v-model="roleName">
        <option value="chair">Show only Chairs</option>
        <option value="captain">Show only Captains</option>
        <option value="sv">Show only SVs</option>
        <option value="all">Show all roles</option>
      </b-select>-->

      <b-input
        expanded
        @input="debounceLoadAsyncData"
        :placeholder="`search in ${total} users..`"
        v-model="searchString"
      ></b-input>
    </b-field>

    <b-table
      :data="data"
      :loading="loading"
      paginated
      narrowed
      backend-pagination
      backend-sorting
      :total="total"
      :per-page="perPage"
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
        <b-table-column width="100" label="Actions">
          <div class="buttons">
            <b-button
              type="is-inverted"
              @click="goTo(`/user/${props.row.id}/tasks`)"
              icon-left="format-list-checks"
            >tasks</b-button>
          </div>
        </b-table-column>

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
    </b-table>
  </section>
</template>


<script>
import debounce from "lodash/debounce";

export default {
  data() {
    return {
      data: [],
      total: 0,
      loading: false,
      sortField: "firstname",
      sortOrder: "asc",
      roleName: "sv",
      searchString: "",
      defaultSortOrder: "asc",
      page: 1,
      perPage: 25
    };
  },
  methods: {
    debounceLoadAsyncData: debounce(function() {
      this.loadAsyncData();
    }, 250),
    loadAsyncData() {
      const params = [
        `sort_by=${this.sortField}`,
        `sort_order=${this.sortOrder}`,
        `page=${this.page}`,
        `per_page=${this.perPage}`,
        `search_string=${this.searchString}`,
        `role_name=${this.roleName}`
      ].join("&");

      this.loading = true;
      axios
        .get(`user?${params}`)
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
