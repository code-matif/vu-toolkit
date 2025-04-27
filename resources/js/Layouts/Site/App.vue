<template>
  <Header />
  <main class="main">
    <slot />
  </main>
  <Footer />
  <ScrollTop />
  <Preloader />
</template>

<script setup>
import Header from '@/Components/Site/Header.vue'
import Footer from '@/Components/Site/Footer.vue'
import ScrollTop from '@/Components/Site/ScrollTop.vue'
import Preloader from '@/Components/Site/Preloader.vue'
</script>
