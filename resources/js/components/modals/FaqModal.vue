<template>
  <div class="modal-card" style="width: 1000px; max-width:100%">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ form.title }}</p>
    </header>
    <section class="modal-card-body">
      <b-field
        expanded
        required
        :type="{ 'is-danger': form.errors.has('title') }"
        :message="form.errors.get('title')"
        label="Title"
      >
        <b-input required v-model="form.title" maxlength="255"></b-input>
      </b-field>

      <b-field
        expanded
        required
        :type="{ 'is-danger': form.errors.has('body') }"
        :message="form.errors.get('body')"
        label="Body"
      >
        <markdown-input v-model="form.body"></markdown-input>
      </b-field>

      <b-field
        expanded
        required
        :type="{ 'is-danger': form.errors.has('keywords') }"
        :message="form.errors.get('keywords')"
        label="Keywords"
      >
        <b-taginput
          @input="onKeywordsChange()"
          icon="tag"
          :attached="true"
          placeholder="Give this topic some keywords"
          v-model="form.keywords"
        ></b-taginput>
      </b-field>

      <b-field
        expanded
        :type="{ 'is-danger': form.errors.has('role_id') }"
        :message="form.errors.get('role_id')"
        label="Visibility restrictions"
      >
        <b-field grouped group-multiline class="is-block">
          <b-switch
            v-model="restrictToRole"
            @input="$event ? form.role_id = 10 : form.role_id = null"
          >{{ restrictToRole ? "Requires a minimum role (SV &lt; Captain &lt; Chair &lt; Admin)" : "Everyone can see" }}</b-switch>
          <role-picker v-if="restrictToRole" v-model="form.role_id"></role-picker>
        </b-field>
      </b-field>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Cancel</b-button>
      <b-button @click="save()" type="is-success">{{ form.id ? 'Save' : 'Create'}}</b-button>
    </section>
    <b-loading :is-full-page="false" :active="isLoading" />
  </div>
</template>

<script>
import Form from "vform";
import api from "@/api";

export default {
  props: ["faq", "event"],

  data() {
    return {
      isLoading: false,
      restrictToRole: false,
      form: new Form({
        id: null,
        title: "",
        body: "",
        keywords: [],
        role_id: null
      })
    };
  },

  methods: {
    onKeywordsChange() {
      this.form.keywords = this.form.keywords.map(keyword => {
        return keyword.charAt(0).toUpperCase() + keyword.slice(1).toLowerCase();
      });
      this.form.keywords = [...new Set(this.form.keywords)];
    },
    save() {
      if (this.faq?.id) {
        // Update
        api
          .updateFaq(this.faq.id, this.form)
          .then(({ data }) => {
            this.event("update", data.result);
            this.$parent.close();
          })
          .finally(() => (this.isLoading = false));
      } else {
        // Create
        api
          .createFaq(this.form)
          .then(({ data }) => {
            this.event("create", data.result);
            this.$parent.close();
          })
          .finally(() => (this.isLoading = false));
      }
    }
  },

  created() {
    if (this.faq) {
      this.form.fill(this.faq);
      this.restrictToRole = !!this.faq.role_id;
    }
  }
};
</script>
