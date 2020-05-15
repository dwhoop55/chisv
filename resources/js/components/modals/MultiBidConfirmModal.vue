<template>
  <div class="modal-card" style="max-width:100%">
    <header class="modal-card-head">
      <p class="modal-card-title">Multi-bid {{ preference === null ? "(revoke)" : "" }}</p>
    </header>
    <section class="modal-card-body">
      <p>
        You are about to
        <b>{{ preference === null ? 'revoke your bid' : 'bid'}}</b>
        on up to {{ totalTasks }}
        tasks.
      </p>
      <p v-if="perPage < totalTasks">
        Your {{ preference === null ? 'bid revocation' : "bid"}} will be applied to all
        {{ Math.ceil(totalTasks / perPage)}} pages of the table and not
        only the page ({{ page }}) you are currently on.
      </p>
      <b-field>&nbsp;</b-field>
      <p>Please note: Your multi-bid will only be applied to the tasks for which you can bid. These may actually be less than all {{ totalTasks }} tasks you've filtered for.</p>
      <b-field>&nbsp;</b-field>
      <b-field>
        <b-switch
          :value="!warnBeforeMultiBid"
          @input="setWarnBeforeMultiBid(!$event)"
        >Do not show this warning again before sending a multi-bid</b-switch>
      </b-field>
    </section>
    <section class="modal-card-foot">
      <b-button @click="$parent.close()">Cancel</b-button>
      <b-button type="is-primary" @click="confirm();$parent.close()">
        <div v-if="preference !== null">
          Bid
          on up to {{ totalTasks }} tasks
          with preference
          <b>{{ preferenceString(preference) }}</b>
        </div>
        <div v-else>Revoke bids</div>
      </b-button>
    </section>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
  props: ["preference", "totalTasks", "confirm", "perPage", "page"],

  computed: mapGetters("tasks", ["warnBeforeMultiBid"]),
  methods: mapMutations("tasks", ["setWarnBeforeMultiBid"])
};
</script>