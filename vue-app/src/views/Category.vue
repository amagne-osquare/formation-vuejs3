<template>
  <div class="section category" v-if="category">
    <nav class="breadcrumb" aria-label="breadcrumbs">
      <ul>
        <li><a href="{{ path('homepage') }}">Homepage</a></li>
        <li class="is-active"><a href="#" aria-current="page">{{ category.name }}</a></li>
      </ul>
    </nav>
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
import ProductItem from '@/components/ProductItem.vue';

export default {
  components: {
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
  async created() {
    this.category = await axiosInstance.get(this['@id']);
  },
}
</script>
