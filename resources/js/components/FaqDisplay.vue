<template>
  <div>
    <b-loading :is-full-page="false" :active="isLoading" />
    <VueShowdown :markdown="faq ? faq.body : '###Loading..'" />&nbsp;
    <div v-if="faq" class="columns">
      <div class="column is-2 has-text-left">
        <b-button
          v-if="faq && (userIs('admin') || userIs('chair'))"
          @click="edit()"
          size="is-small"
          type="is-primary"
        >Edit</b-button>
        <b-button
          v-if="faq && (userIs('admin') || userIs('chair'))"
          @click="removeConfirm()"
          size="is-small"
          type="is-danger"
        >Delete</b-button>
      </div>
      <div class="column has-text-right">
        <b-tag
          @click.native="$emit('click-keyword', keyword)"
          rounded
          size="is-small"
          class="has-margin-l-7"
          type="is-light"
          :key="index"
          v-for="(keyword, index) in faq.keywords"
        >{{keyword}}</b-tag>
        <b-tag type="is-light" class="has-margin-l-7 has-text-grey">{{ faq.view_count }} views</b-tag>
        <span v-if="userIs('admin') || userIs('chair')" class="has-margin-l-7 has-text-grey">
          <b-tag :type="roleType(faq.role)">
            Visible for
            <role-tag :role="faq.role"></role-tag>and higher
          </b-tag>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/api";
import { mapGetters } from "vuex";
import FaqModalVue from "./modals/FaqModal.vue";
export default {
  name: "FaqDisplay",
  props: ["id"],

  data() {
    return {
      faq: null,
      isLoading: true
    };
  },

  created() {
    this.getFaq();
  },

  methods: {
    remove() {
      this.isLoading = true;
      api
        .deleteFaq(this.faq.id)
        .then(() => this.$emit("delete"))
        .finally(() => (this.isLoading = false));
    },
    removeConfirm() {
      this.$buefy.dialog.confirm({
        title: "Caution!",
        message: `Want to delete this (${this.faq.title}) FAQ?`,
        confirmText: "Delete",
        type: "is-danger",
        hasIcon: true,
        onConfirm: () => this.remove()
      });
    },
    edit() {
      this.$buefy.modal.open({
        parent: this,
        component: FaqModalVue,
        props: {
          faq: this.faq,
          event: (event, faq) => {
            this.faq = faq;
            this.$emit(event, faq);
          }
        },
        hasModalCard: true,
        trapFocus: true
      });
    },
    getFaq() {
      api
        .getFaq(this.id)
        .then(({ data }) => (this.faq = data))
        .finally(() => (this.isLoading = false));
    }
  },

  computed: {
    ...mapGetters("auth", ["userIs"])
  }
};
</script>
