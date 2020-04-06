<template>
  <div>
    <b-loading :is-full-page="false" :active="isLoading" />
    <VueShowdown :markdown="faq ? faq.body : '###Loading..'" />&nbsp;
    <div v-if="faq">
      <div class="has-text-right">
        Keywords
        <b-tag
          @click.native="$emit('click-keyword', keyword)"
          rounded
          size="is-small"
          class="has-margin-l-7"
          type="is-light"
          :key="index"
          v-for="(keyword, index) in faq.keywords"
        >{{keyword}}</b-tag>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/api";
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
    getFaq() {
      api
        .getFaq(this.id)
        .then(({ data }) => (this.faq = data))
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>
