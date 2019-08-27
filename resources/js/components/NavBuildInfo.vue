<template>
  <div @click="show">
    <a class="navbar-item">chisv Version</a>
  </div>
</template>

<script>
import api from "@/api.js";

export default {
  data() {
    return {
      branch: null,
      commit: null,
      showVersionModal: false
    };
  },

  methods: {
    show: function() {
      api.getVersion().then(data => {
        let info = data.data;
        this.branch = info.branch;
        this.commit = info.commit;

        this.$buefy.dialog.alert({
          title: "chisv Version",
          message: `Branch<br/><b>${this.branch}</b><br/><br/>Commit<br/><b>${this.commit}</b>`,
          type: "is-info",
          hasIcon: true,
          icon: "information"
        });
      });
    }
  }
};
</script>
