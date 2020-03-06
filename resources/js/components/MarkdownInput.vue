<template>
  <div>
    <b-field>
      <p class="control">
        <button @click.prevent="add('**This text is bold**')" class="button is-small">
          <b-icon icon="format-bold"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('*This text is italic*')" class="button is-small">
          <b-icon icon="format-italic"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('~~This text is strikethrough~~')" class="button is-small">
          <b-icon icon="format-strikethrough"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('# H1 Header')" class="button is-small">
          <b-icon icon="format-header-1"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('## H2 Header')" class="button is-small">
          <b-icon icon="format-header-2"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('### H3 Header')" class="button is-small">
          <b-icon icon="format-header-3"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('1. First item\n2. Second Item')" class="button is-small">
          <b-icon icon="format-list-numbered"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('* Some item\n* Another Item')" class="button is-small">
          <b-icon icon="format-list-bulleted"></b-icon>
        </button>
      </p>
      <p class="control">
        <button @click.prevent="add('`This will be monospaced`')" class="button is-small">
          <b-icon icon="information-variant"></b-icon>
        </button>
      </p>
      <p class="control">
        <button
          @click.prevent="add('[Use a link like this](https://chisv.org/)\n\nOr like this: This is a [link to google][1]\n\n[1]: www.google.com')"
          class="button is-small"
        >
          <b-icon icon="link"></b-icon>
        </button>
      </p>
    </b-field>
    <b-input expanded @input="$emit('input', $event)" :value="value" type="textarea"></b-input>
  </div>
</template>

<script>
export default {
  props: ["value"],

  methods: {
    add(text) {
      this.$emit("input", this.value + "\n" + text);
    }
  }
};
</script>
