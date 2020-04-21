<template>
  <div>
    <b-field grouped group-multiline>
      <b-button size="is-small" @click="add('**This text is bold**')">
        <b-icon icon="format-bold"></b-icon>
      </b-button>
      <b-button size="is-small" @click="add('*This text is italic*')">
        <b-icon icon="format-italic"></b-icon>
      </b-button>
      <b-button size="is-small" @click="add('~~This text is strikethrough~~')">
        <b-icon icon="format-strikethrough"></b-icon>
      </b-button>

      <b-button size="is-small" @click="add('# H1 Header')">
        <b-icon icon="format-header-1"></b-icon>
      </b-button>
      <b-button size="is-small" @click="add('## H2 Header')">
        <b-icon icon="format-header-2"></b-icon>
      </b-button>
      <b-button size="is-small" @click="add('### H3 Header')">
        <b-icon icon="format-header-3"></b-icon>
      </b-button>

      <b-button size="is-small" @click="add('1. First item\n2. Second Item')">
        <b-icon icon="format-list-numbered"></b-icon>
      </b-button>
      <b-button size="is-small" @click="add('* Some item\n* Another Item')">
        <b-icon icon="format-list-bulleted"></b-icon>
      </b-button>

      <b-button size="is-small" @click="add('`This will be monospaced`')">
        <b-icon icon="information-variant"></b-icon>
      </b-button>
      <b-button
        size="is-small"
        @click="add('[Use a link like this](https://chisv.org/)\n\nOr like this: This is a [link to google][1]\n\n[1]: www.google.com')"
      >
        <b-icon icon="link"></b-icon>
      </b-button>

      <b-button size="is-small" @click="preview()">Preview</b-button>
    </b-field>
    <b-input
      expanded
      :placeholder="placeholder"
      :maxlength="maxlength"
      @input="$emit('input', $event)"
      :value="value"
      type="textarea"
    ></b-input>
  </div>
</template>

<script>
const preview = {
  props: ["markdown"],
  template: `
        <div class="modal-card">
           <header class="modal-card-head">
               <p class="modal-card-title">Preview</p>
           </header>
           <section class="modal-card-body">
              <VueShowdown :markdown="markdown"/>
           </section>
           <footer class="modal-card-foot">
               <b-button @click="$parent.close()">Close</b-button>
           </footer>
        </div>
        `
};

export default {
  props: ["value", "placeholder", "maxlength"],

  components: {
    preview
  },

  methods: {
    preview() {
      this.$buefy.modal.open({
        parent: this,
        component: preview,
        props: { markdown: this.value },
        hasModalCard: true,
        trapFocus: true
      });
    },
    add(text) {
      this.$emit("input", this.value + "\n" + text);
    }
  }
};
</script>
