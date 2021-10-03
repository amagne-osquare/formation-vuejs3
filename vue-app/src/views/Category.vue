<template>
  <div class="section category" v-if="category">
    <breadcrumbs :current="category.name" />
    <h1 class="title">{{ category.name }}</h1>
    <div class="notification is-primary">{{ category.description }}</div>

    <div v-if="category.products.length" class="columns products is-multiline">
      <ProductItem
        v-for="product in category.products"
        :key="product['@id']"
        :product="product"
        class="column is-one-quarter"
      />
    </div>
    <div v-else class="buttons is-centered">
      <router-link class="button is-rounded is-centered is-link" :to="{ name: 'homepage' }">
        Aucun résultat ici. Retour à la page d'accueil.
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { computed, toRef } from 'vue';
import { useStore } from 'vuex';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import ProductItem from '@/components/ProductItem.vue';
import { useFetcher } from '@/composables/useFetcher';

const props = defineProps({
  '@id': { type: String, required: true },
});

useFetcher(toRef(props, '@id'));
const store = useStore();
const category = computed(() => store.state.category.item);
</script>
