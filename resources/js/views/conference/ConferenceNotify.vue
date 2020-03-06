<template>
  <div>
    <b-loading :active="isLoading" :is-full-page="true" />
    <b-field expanded>
      <notify-destination-picker
        :conference="conference"
        @input="onDestinationChange($event)"
        :value="form.destinations"
      />
    </b-field>
    <b-notification
      :closable="false"
      v-if="errorsFor('destinations')"
      type="is-danger"
      :message="errorsFor('destinations')"
    />
    <div class="columns">
      <div class="column">
        <form>
          <!-- Subject and Greeting -->
          <div class="notification">
            <div class="field is-floating-label">
              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('subject') }"
                :message="form.errors.get('subject')"
                label="Subject"
              >
                <b-input
                  maxlength="70"
                  @input="onSubjectChange($event)"
                  :value="form.subject"
                  placeholder="Put a subject here"
                />
              </b-field>
            </div>
            <div class="field is-floating-label">
              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('greeting') }"
                :message="form.errors.get('greeting')"
                label="Greeting (clear for 'Hello {firstname},')"
              >
                <b-input
                  maxlength="70"
                  @input="onGreetingChange($event)"
                  :value="form.greeting"
                  placeholder="Hello, {firstname},"
                />
              </b-field>
            </div>
            <div class="field is-floating-label">
              <b-field
                expanded
                :type="{ 'is-danger': form.errors.has('salutation') }"
                :message="form.errors.get('salutation')"
                label="Salutation"
              >
                <b-input
                  maxlength="70"
                  @input="onSalutationChange($event)"
                  type="textarea"
                  :value="form.salutation"
                  placeholder="Put a salutation here"
                />
              </b-field>
            </div>
          </div>

          <!-- Add elments -->
          <div class="notification">
            <label class="label">Add Elements</label>
            <b-field class="buttons" grouped group-multiline>
              <b-button
                @click="addElement(element)"
                :disabled="element.type == 'action' && !canAddAction"
                :icon-left="iconForElement(element.type)"
                v-for="(element, index) in availableElements"
                :key="index"
              >{{ element.type | capitalize }}</b-button>
            </b-field>
          </div>

          <!-- Active elements -->
          <b-notification
            :closable="false"
            v-if="errorsFor('elements')"
            type="is-danger"
            :message="errorsFor('elements')"
          />
          <notify-element
            class="box"
            @move="move(index, $event)"
            @remove="remove($event)"
            :type="element.type"
            :index="index"
            v-model="element.data"
            v-for="(element, index) in form.elements"
            :key="index"
            :can-move-up="canMove('up', index)"
            :can-move-down="canMove('down', index)"
          />
        </form>
      </div>

      <div class="column message">
        <div class="message-header">
          <p>Preview{{ form.subject ? ': ' + form.subject : ' Announcement'}}</p>
        </div>
        <div class="message-body">
          <notify-message
            :subject="form.subject"
            :greeting="form.greeting"
            :elements="form.elements"
            :salutation="form.salutation"
          />
        </div>
      </div>
    </div>
    <b-field grouped position="is-right">
      <b-button @click="send" icon-right="send" type="is-primary">Send</b-button>
    </b-field>
  </div>
</template>

<script>
import api from "@/api.js";
import { Form } from "vform";

export default {
  props: ["conference"],

  data() {
    return {
      isLoading: false,
      canAddAction: true,
      availableElements: [
        {
          type: "markdown",
          data:
            "## Some Heading\nA *paragraph*\n\nAnother **paragraph** with [url](https://chisv.org)\n\n* A\n* list"
        },
        {
          type: "action",
          data: {
            caption: "Click to view",
            url: "https://chisv.org/conference/"
          }
        }
      ],
      form: new Form({
        subject: "SV Announcement",
        greeting: "Hi everyone,",
        salutation: "Regards,",
        elements: [],
        destinations: []
      })
    };
  },

  mounted() {
    this.availableElements[1].data.url += this.conference.key;
    this.form.salutation += `\n${this.conference.key} chair`;
  },

  methods: {
    send() {
      this.$buefy.dialog.confirm({
        confirmText: "Send!",
        message: "Ready to send?",
        type: "is-primary",
        hasIcon: true,
        icon: "send",
        onConfirm: () => {
          this.isLoading = true;
          api
            .postNotification(this.conference.key, this.form)
            .then(({ data }) => {
              this.$buefy.dialog.alert({
                message: data.message,
                type: "is-success",
                hasIcon: true
              });
            })
            .catch(error => {
              if (error.response.status != 422) {
                this.$buefy.notification.open({
                  infinite: true,
                  message: error.message,
                  type: "is-danger",
                  hasIcon: true
                });
              }
            })
            .finally(() => {
              this.isLoading = false;
            });
        }
      });
    },
    errorsFor(pattern) {
      var keys = Object.keys(this.form.errors.all()).filter(function(key) {
        var regex = new RegExp(pattern + ".*", "g");
        return regex.test(key);
      });

      if (keys.length > 0) {
        var message = `The ${pattern} field has invalid items:<br>`;
        keys.forEach(key => {
          message += `${key}: ${this.form.errors.get(key)}<br>`;
        });
        return message;
      } else {
        return null;
      }
    },
    iconForElement(type) {
      if (type == "markdown") {
        return "text";
      } else if (type == "action") {
        return "cursor-default-click";
      }
    },
    addElement(element) {
      // Copy the element
      var newElement = { ...element };
      if (element.type == "action") {
        if (!this.canAddAction) return;
        newElement.data = { ...element.data };
        this.canAddAction = false;
      }
      this.form.elements.push(newElement);
      this.form.errors.clear("elements");
    },

    // Ensure that an element does not get above a subject
    // or out of the list
    canMove(direction, index) {
      if (direction == "up" && index == 0) {
        return false;
      } else if (
        direction == "down" &&
        index == this.form.elements.length - 1
      ) {
        return false;
      } else {
        return true;
      }
    },
    move(oldIndex, newIndex) {
      let direction = newIndex > oldIndex ? "down" : "up";
      if (!this.canMove(direction, oldIndex)) return false;

      this.form.elements.move(oldIndex, newIndex);
    },
    remove(index) {
      if (this.form.elements[index].type == "action") {
        this.canAddAction = true;
      }
      this.form.elements.splice(index, 1);
    },
    onDestinationChange(destinations) {
      this.form.destinations = destinations;
      this.form.errors.clear("destinations");
    },
    onGreetingChange(event) {
      this.form.greeting = event !== "" ? event : null;
      this.form.errors.clear("greeting");
    },
    onSalutationChange(event) {
      this.form.salutation = event !== "" ? event : null;
      this.form.errors.clear("salutation");
    },
    onSubjectChange(event) {
      this.form.subject = event !== "" ? event : null;
      this.form.errors.clear("subject");
    }
  }
};
</script>
