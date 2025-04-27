<template>
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Muhammad Atif</h1>
      </a>

    <Nav />

    </div>
  </header>
</template>

<script setup>
import Nav from '@/Components/Site/Nav.vue'
</script>

<script>
export default {
  name: 'Header'
}
</script>
