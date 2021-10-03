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

<script>
import { axiosInstance } from '@/api/axios';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import ProductItem from '@/components/ProductItem.vue';

export default {
  components: {
    Breadcrumbs,
    ProductItem,
  },
  data() {
    return {
      category: null,
    };
  },
  props: {
    '@id': { type: String, required: true },
  },
  watch: {
    '@id': {
      async handler() {
        this.category = await axiosInstance.get(this['@id']);
      },
      immediate: true,
    },
  },
}
</script>
