<script setup>
import App from '@/Layouts/Site/App.vue'
</script>

<template>
  <App>
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Home</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Coming Soon</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Coming Soon Section -->
    <section id="coming-soon-section" class="coming-soon-section section">
      <div class="container section-title text-center" data-aos="fade-up">
        <h2>Coming Soon</h2>
        <p>We're working hard to bring this page to life. Stay tuned!</p>
      </div>

    </section>

    <!-- Optionally, you can hide the original section you were using for the starter page -->
    <section id="starter-section" class="starter-section section" style="display: none;">
      <div class="container section-title" data-aos="fade-up">
        <h2>Starter Section</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div>

      <div class="container" data-aos="fade-up">
        <p>Use this page as a starter for your own custom pages.</p>
      </div>
    </section>
  </App>
</template>
