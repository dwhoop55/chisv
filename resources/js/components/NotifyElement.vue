<template>
  <div class="field is-floating-label">
    <label class="label">{{ type | capitalize }}</label>
    <b-field grouped>
      <b-field expanded>
        <markdown-input @input="$emit('input', $event)" :value="value" v-if="isInput"></markdown-input>
        <b-field grouped group-multiline v-else-if="isAction">
          <b-input
            @input="onActionChange('caption', $event)"
            expanded
            placeholder="Caption"
            :value="value.caption"
          />
          <b-input
            @input="onActionChange('url', $event)"
            expanded
            placeholder="Url"
            :value="value.url"
          />
        </b-field>
      </b-field>
      <b-field>
        <b-icon
          @click.native="$emit('remove', index)"
          type="is-primary"
          class="is-clickable"
          icon="delete"
        ></b-icon>
        <b-icon
          :type="canMoveUp ? 'is-primary' : 'is-light'"
          @click.native="$emit('move', index-1)"
          :class="{'is-clickable' : canMoveUp }"
          icon="arrow-up"
        ></b-icon>
        <b-icon
          :type="canMoveDown ? 'is-primary' : 'is-light'"
          @click.native="$emit('move', index+1)"
          :class="{'is-clickable' : canMoveDown }"
          icon="arrow-down"
        ></b-icon>
      </b-field>
    </b-field>
  </div>
</template>

<script>
export default {
  props: ["type", "value", "index", "canMoveUp", "canMoveDown"],

  computed: {
    isInput() {
      return this.type == "markdown";
    },
    isAction() {
      return this.type == "action";
    }
  },

  methods: {
    onActionChange(type, input) {
      var event = this.value;
      if (type == "caption") {
        event.caption = input;
        this.$emit("input", event);
      } else {
        event.url = input;
        this.$emit("input", event);
      }
    }
  }
};
</script>
