<template>
  <section>
    <div class="columns is-multiline is-flex-stretch">
      <div v-for="link in links" :key="link.name">
        <div class="column">
          <a @click="click(link)">
            <div :class="cardClass(link)">
              <p>{{link.name}}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["user"],

  methods: {
    cardClass(link) {
      return `card ${link.color} notification is-hoverable-anim is-clickable is-100vh has-text-centered is-size-4 has-padding-1`;
    },
    click(element) {
      if (element.store) {
        this.$store.commit(element.store.key, element.store.value);
      }
      this.goTo(element.path);
    }
  },

  data() {
    return {
      links: [
        { name: "All Conferences", path: "/conference", color: "is-success" },
        {
          name: "My Conferences",
          path: `/user/${this.user.id}/edit`,
          store: { key: "PROFILE_TAB", value: 0 },
          color: "is-warning"
        }
      ]
    };
  }
};
</script>
