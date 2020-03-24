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
          <router-link :to="{name: 'user', params: {id: props.row.id}}">{{ props.row.firstname }}</router-link>
        </b-table-column>

        <b-table-column field="lastname" label="Lastname" sortable>
          <router-link :to="{name: 'user', params: {id: props.row.id}}">{{ props.row.lastname }}</router-link>
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
        <b-button type="is-primary" @click="fetchUsers()">Reload</b-button>
      </template>
    </b-table>
  </section>
</template>


<script>
import { mapMutations, mapGetters, mapActions } from "vuex";
export default {
  methods: {
    onUniversityChange(university) {
      this.setUniversity(university);
      this.fetchUsers();
    },
    onPageChange(page) {
      this.setPage(page);
      this.fetchUsers();
    },
    onPerPageChange(perPage) {
      this.setPerPage(perPage);
      this.fetchUsers();
    },
    onSort(field, direction) {
      this.setSortField(field);
      this.setSortDirection(direction);
      this.fetchUsers();
    },
    onSearch(search) {
      this.setSearch(search);
      this.fetchUsers();
    },
    ...mapMutations("userIndex", [
      "setUniversity",
      "setSearch",
      "setSortField",
      "setSortDirection",
      "setPerPage",
      "setPage"
    ]),
    ...mapActions("userIndex", ["fetchUsers"])
  },

  computed: mapGetters("userIndex", [
    "search",
    "university",
    "perPage",
    "page",
    "sortField",
    "sortDirection",
    "data",
    "isLoading"
  ]),

  mounted() {
    this.fetchUsers();
  }
};
</script>
