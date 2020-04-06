<template>
  <div>
    <div>
      <div
        class="is-fixed is-100hw is-100vh is-pinned-l is-pinned-t is-cover is-below is-blurred is-visible-8"
        :style="conferenceArtworkBackground(lastConference)"
      ></div>

      <transition name="fade">
        <div class="is-relative">
          <div class="columns is-centered">
            <div class="column card is-7 has-padding-5">
              <b-loading :is-full-page="false" :active="isLoading"></b-loading>
              <b-taginput
                v-model="activeKeywords"
                :data="filteredKeywords"
                autocomplete
                :allow-new="false"
                open-on-focus
                icon="label"
                placeholder="Select keywords.."
                @input="onKeywordsChange($event)"
                @typing="getFilteredTags"
              ></b-taginput>
              <hr />
              <b-collapse
                class="card"
                style="border-radius: 0px;"
                animation="slide"
                v-for="faq of matchedFaqs"
                :key="faq.id"
                :open="isOpen == faq.id"
                @open="isOpen = faq.id"
              >
                <div slot="trigger" slot-scope="props" class="card-header" role="button">
                  <p class="card-header-title">{{ faq.title }}</p>
                  <a class="card-header-icon">
                    <b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon>
                  </a>
                </div>
                <div class="card-content">
                  <div class="content">
                    <faq-display v-if="faq.id == isOpen" :id="faq.id" />
                  </div>
                </div>
              </b-collapse>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import api from "@/api";

export default {
  name: "faqs",

  data() {
    return {
      faqs: [],
      keywords: [],
      activeKeywords: [],
      filteredKeywords: [],
      isLoading: false,
      isOpen: null,
      matchedFaqs: []
    };
  },

  created() {
    this.getFaqs();
  },

  methods: {
    getFilteredTags(text) {
      this.filteredKeywords = this.keywords.filter(keyword => {
        return keyword.toLowerCase().indexOf(text.toLowerCase()) >= 0;
      });
    },
    onKeywordsChange(tags) {
      if (tags.length === 0) {
        this.matchedFaqs = this.faqs;
        return;
      }
      this.matchedFaqs = this.faqs.filter(faq => {
        var matches = faq.keywords.filter(keyword =>
          this.activeKeywords.includes(keyword)
        );
        return matches.length > 0;
      });
    },
    refreshKeywords() {
      this.faqs.forEach(faq => {
        this.keywords = [...this.keywords, ...new Set(faq.keywords)];
        this.keywords.sort();
      });
      this.filteredKeywords = this.keywords;
    },
    getFaqs() {
      this.isLoading = true;
      api
        .getFaqs()
        .then(({ data }) => {
          this.faqs = data;
          this.matchedFaqs = this.faqs;
          // We now attach the roles from our vuex store
          this.refreshKeywords();
        })
        .finally(() => (this.isLoading = false));
    }
  },

  computed: {
    ...mapGetters("defines", ["roles"]),
    ...mapGetters("conference", {
      lastConference: "conference"
    })
  }
};
</script>