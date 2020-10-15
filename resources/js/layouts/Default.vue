<template>
  <div>
    <navbar></navbar>

    <div class="section">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: "default-layout",
};
</script>

<style>
</style>