<template>
  <nav class="navbar is-fixed-top is-dark">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <img alt="Logo" src="@/assets/logo.svg" width="112" />
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
        <router-link
          v-for="category in categories"
          :key="category['@id']"
          class="navbar-item"
          :to="{ path: category['@id'] }"
        >
          {{ category.name }}
        </router-link>
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
</template>

<script setup>
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';

const store = useStore();
const categories = computed(() => store.state.category.items);

onMounted(() => store.dispatch('category/fetchAll'));
</script>
