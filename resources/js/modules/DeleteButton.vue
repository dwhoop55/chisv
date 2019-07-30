<template>
  <button class="button is-danger" @click.prevent="confirmDelete">{{ label }}</button>
</template>

<script>
export default {
  props: ["return", "label", "title", "message", "resource", "id"],
  data() {
    return {};
  },
  methods: {
    confirmDelete: function() {
      this.$dialog.confirm({
        title: this.title,
        message: this.message,
        confirmText: "Delete",
        type: "is-danger",
        hasIcon: true,
        onConfirm: this.deleteResource
      });
    },
    deleteResource: function() {
      axios
        .delete(`/api/${this.resource}/${this.id}`)
        .then(data => {
          this.goTo(this.return);
        })
        .catch(data => {
          console.log(data.response);
          this.$toast.open({
            duration: 5000,
            message: `Could not delete: ${data.response.statusText}`,
            type: "is-danger"
          });
        });
    }
  }
};
</script>
