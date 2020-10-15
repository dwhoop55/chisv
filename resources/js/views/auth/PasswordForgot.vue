<template>
  <div class="columns is-centered">
    <div class="column is-one-third">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title is-block has-text-centered">
            Request new password
          </p>
        </header>
        <div class="card-content">
          <b-field>
            <b-input
              icon="at"
              type="email"
              placeholder="E-Mail Address"
              name="email"
              required
              autofocus
            />
          </b-field>

          <b-button type="is-primary"> Send Password Reset Link </b-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>