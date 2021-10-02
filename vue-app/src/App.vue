<template>
  <nav class="navbar is-fixed-top is-dark">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <img alt="Logo" src="./assets/logo.svg" width="112" />
      </a>
      <div class="navbar-burger" data-target="navMenu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <div id="navMenu" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="/">Accueil</a>
        <a
          v-for="category in categories"
          :key="category['@id']"
          class="navbar-item"
          href="#"
        >
          {{ category.name }}
        </a>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <div class="button is-primary is-small">Mon panier</div>
            <div class="button is-white is-small">Mon compte</div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <Home />
</template>

<script>
import { axiosInstance } from '@/api/axios';
import Home from '@/views/Home.vue';

export default {
  components: {
    Home,
  },
  data() {
    return {
      categories: [],
    };
  },
  async created() {
    const res = await axiosInstance.get('/categories');
    this.categories = res['hydra:member'];
  },
}
</script>

<style lang="scss">
@import 'assets/scss/styles';
</style>