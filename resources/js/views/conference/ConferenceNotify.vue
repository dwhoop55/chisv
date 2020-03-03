<template>
  <div>
    <div class="columns">
      <div class="column">
        <!-- Subject and Greeting -->
        <div class="notification">
          <div class="field is-floating-label">
            <label class="label">Subject</label>
            <b-input
              @input="onSubjectChange($event)"
              type="is-primary"
              :value="subject"
              placeholder="Put a subject here"
            />
          </div>
          <div class="field is-floating-label">
            <label class="label">Greeting</label>
            <b-input
              @input="onGreetingChange($event)"
              type="is-primary"
              :value="greeting"
              placeholder="Put a greeting here"
            />
          </div>
        </div>

        <!-- Add elments -->
        <div class="notification">
          <label class="label">Add Elements</label>
          <b-field class="buttons" grouped group-multiline>
            <b-button
              @click="addElement(element)"
              :icon-left="iconForElement(element.type)"
              v-for="(element, index) in availableElements"
              :key="index"
            >{{ element.type | capitalize }}</b-button>
          </b-field>
        </div>

        <!-- Active elements -->
        <notify-element
          class="box"
          @move="move(index, $event)"
          @remove="remove($event)"
          :type="element.type"
          :index="index"
          v-model="element.data"
          v-for="(element, index) in elements"
          :key="index"
          :can-move-up="canMove('up', index)"
          :can-move-down="canMove('down', index)"
        />
      </div>

      <div class="column message">
        <div class="message-header">
          <p>Preview{{ subject ? ': ' + subject : ''}}</p>
        </div>
        <div class="message-body">
          <notify-message :subject="subject" :greeting="greeting" :elements="elements" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["conference"],

  data() {
    return {
      subject: "SV Announcement",
      greeting: "Hi everyone,",
      elements: [],
      availableElements: [
        { type: "title", data: "Section in message for structure" },
        { type: "text", data: "Some text.." },
        {
          type: "action",
          data: {
            caption: "Click to view",
            url: "https://chisv.org/conference/"
          }
        }
      ]
    };
  },

  mounted() {
    this.availableElements[2].data.url += this.conference.key;
  },

  methods: {
    iconForElement(type) {
      if (type == "text") {
        return "text";
      } else if (type == "title") {
        return "format-title";
      } else if (type == "action") {
        return "cursor-default-click";
      }
    },
    addElement(element) {
      // Copy the element
      let newElement = { ...element };

      // Test if there is already a subject
      if (
        element.type == "subject" &&
        this.elements.filter(e => e.type == "subject").length > 0
      ) {
        this.$buefy.toast.open({
          message: "Only one subject possible",
          type: "is-danger"
        });

        return;
      } else if (element.type == "subject") {
        // Subject should always be top
        this.elements.unshift(newElement);
      } else {
        this.elements.push(newElement);
      }
    },

    // Ensure that an element does not get above a subject
    // or out of the list
    canMove(direction, index) {
      if (this.elements[index].type == "subject") {
        return false;
      } else if (
        direction == "up" &&
        index == 1 &&
        this.elements[index - 1] &&
        this.elements[index - 1].type == "subject"
      ) {
        return false;
      } else if (direction == "up" && index == 0) {
        return false;
      } else if (direction == "down" && index == this.elements.length - 1) {
        return false;
      }
      return true;
    },

    move(oldIndex, newIndex) {
      let direction = newIndex > oldIndex ? "down" : "up";
      if (!this.canMove(direction, oldIndex)) return false;

      this.elements.move(oldIndex, newIndex);
    },

    remove(index) {
      this.elements.splice(index, 1);
    },

    onGreetingChange(event) {
      this.greeting = event !== "" ? event : null;
    },

    onSubjectChange(event) {
      this.subject = event !== "" ? event : null;
    }
  }
};
</script>
