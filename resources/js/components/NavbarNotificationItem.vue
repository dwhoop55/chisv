<template>
  <b-dropdown hoverable ref="dropdown" position="is-bottom-left" aria-role="menu" trap-focus>
    <div class="navbar-item" slot="trigger" slot-scope="{ active }">
      <b-icon class="is-hidden-touch" type="is-white" icon="bell"></b-icon>
      <a class="is-hidden-desktop" type="is-dark">Notifications</a>
    </div>
    <b-dropdown-item aria-role="menu-item" :focusable="false" custom paddingless>
      <form action>
        <div class="modal-card" style="width:300px;">
          <section class="modal-card-body">
            <b-field label="Email">
              <b-input type="email" placeholder="Your email" required></b-input>
            </b-field>

            <b-field label="Password">
              <b-input type="password" password-reveal placeholder="Your password" required></b-input>
            </b-field>

            <b-checkbox>Remember me</b-checkbox>
          </section>
          <footer class="modal-card-foot">
            <button class="button is-primary">Login</button>
          </footer>
        </div>
      </form>
    </b-dropdown-item>
  </b-dropdown>
  <!-- <div class="navbar-item">
    <b-icon @click.native="toggle" icon="bell"></b-icon>
    <b-dropdown ref="dropdown" position="is-bottom-left" aria-role="menu" trap-focus>
      <div class="navbar-item" slot="trigger" slot-scope="{ active }">text</div>
      <b-dropdown-item aria-role="menu-item" :focusable="false" custom paddingless>
        <form action>
          <div class="modal-card" style="width:300px;">
            <section class="modal-card-body">
              <b-field label="Email">
                <b-input type="email" placeholder="Your email" required></b-input>
              </b-field>

              <b-field label="Password">
                <b-input type="password" password-reveal placeholder="Your password" required></b-input>
              </b-field>

              <b-checkbox>Remember me</b-checkbox>
            </section>
            <footer class="modal-card-foot">
              <button class="button is-primary">Login</button>
            </footer>
          </div>
        </form>
      </b-dropdown-item>
    </b-dropdown>
  </div>-->
</template>

<script>
export default {
  methods: {
    toggle(event) {
      this.$refs.dropdown.toggle();
    }
  },
  computed: {
    isDesktop() {
      return !this.$root.showMobileNav;
    }
  }
};
</script>

