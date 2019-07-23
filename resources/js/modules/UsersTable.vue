<template>
  <section>
    <b-field grouped group-multiline>
      <b-select v-model="perPage">
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
      :paginated="true"
      :per-page="perPage"
      :columns="columns"
      default-sort="firstname"
      aria-next-label="Next page"
      aria-previous-label="Previous page"
      aria-page-label="Page"
      aria-current-label="Current page"
    ></b-table>
  </section>
</template>


<script>
export default {
  name: "users-table",
  props: ["users"],
  data() {
    return {
      data: this.users,
      perPage: 25,
      columns: [
        {
          field: "id",
          label: "ID",
          width: "40",
          numeric: true,
          sortable: true
        },
        {
          field: "firstname",
          label: "First Name",
          sortable: true
        },
        {
          field: "lastname",
          label: "Last Name",
          sortable: true
        },
        {
          field: "created_at",
          label: "created",
          centered: true,
          sortable: true
        },
        {
          field: "email",
          label: "E-Mail",
          sortable: true
        },
        {
          field: "university.name",
          label: "University",
          sortable: true
        }
      ]
    };
  }
};
</script>
