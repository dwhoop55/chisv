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
              <b-field v-if="userIs('admin') || userIs('chair')" class="has-text-right">
                <b-button @click="add()" size="is-small">Create new</b-button>
              </b-field>
              <p v-if="!isLoading && (!faqs || faqs.length == 0)">No FAQ yet</p>
              <b-collapse
                class="card"
                style="border-radius: 0px;"
                animation="slide"
                v-for="faq of matchedFaqs"
                :key="faq.id"
                :open="isOpen == faq.id"
                @open="onOpenChange(faq.id)"
              >
                <div slot="trigger" slot-scope="props" class="card-header" role="button">
                  <p class="card-header-title">{{ faq.title }} (#{{ faq.id }})</p>
                  <a class="card-header-icon">
                    <b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon>
                  </a>
                </div>
                <div class="card-content">
                  <div class="content">
                    <faq-display
                      @create="isOpen=null;getFaqs()"
                      @delete="isOpen=null;getFaqs()"
                      @update="getFaqs()"
                      v-if="faq.id == isOpen"
                      :id="faq.id"
                    />
                  </div>
                </div>
              </b-collapse>
              <hr class="has-margin-b-7 has-margin-t-6" />
              <small>
                <div class="level">
                  <div v-if="version.tag" class="level-item">
                    <a
                      target="_blank"
                      :href="`https://github.com/dwhoop55/chisv/releases/tag/${version.tag}`"
                    >Chisv version {{ version.tag }}</a>
                  </div>
                  <div v-if="version.branch" class="level-item">
                    <a
                      target="_blank"
                      href="https://github.com/dwhoop55/chisv"
                    >branch {{ version.branch }}</a>
                  </div>
                  <div v-if="version.commit" class="level-item">
                    <a
                      target="_blank"
                      :href="`https://github.com/dwhoop55/chisv/commit/${version.commit}`"
                    >commit {{ version.commit.substr(0,7) }}</a>
                  </div>
                </div>
              </small>
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
import FaqModalVue from "../../components/modals/FaqModal.vue";

export default {
  name: "faq",

  data() {
    return {
      faqs: [],
      keywords: [],
      activeKeywords: [],
      filteredKeywords: [],
      isLoading: false,
      isOpen: this.$route.params.id || null,
      matchedFaqs: []
    };
  },

  created() {
    this.getFaqs();
  },

  methods: {
    onOpenChange(id) {
      this.isOpen = id;
      this.$router.push({ name: "faq", params: { id } });
    },
    add() {
      this.$buefy.modal.open({
        parent: this,
        component: FaqModalVue,
        props: {
          event: event => {
            this.isOpen = null;
            this.getFaqs();
          }
        }
      });
    },
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
      this.keywords = [];
      this.faqs.forEach(faq => {
        // Make sure every keyword is only present once
        this.keywords = Array.from(
          new Set([...this.keywords, ...faq.keywords])
        );
      });
      this.keywords.sort();
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
    ...mapGetters("auth", ["userIs"]),
    ...mapGetters("defines", ["roles", "version"]),
    ...mapGetters("conference", {
      lastConference: "conference"
    })
  }
};
</script>