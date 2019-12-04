<template>
  <section>
    <div class="columns is-multiline is-flex-stretch">
      <div v-for="link in links" :key="link.name">
        <div class="column">
          <a :href="link.href">
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
    cardClass: function(link) {
      return `card ${link.color} notification is-hoverable-anim is-clickable is-100vh has-text-centered is-size-4 has-padding-1`;
    }
  },

  data() {
    return {
      links: [
        { name: "All Conferences", href: "/conference", color: "is-success" },
        {
          name: "My Conferences",
          href: `/user/${this.user.id}/edit`,
          color: "is-warning"
        }
      ]
    };
  }
};
</script>
