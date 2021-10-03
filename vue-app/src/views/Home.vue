<template>
  <section class="section">
    <h1 class="title has-text-primary">{{ title }}</h1>

    <figure class="image is-3by1">
      <img :src="imageUrl" />
    </figure>

    <hr />

    <template v-if="featured.length">
      <div class="is-flex is-align-items-baseline mb-4">
        <h3 class="is-size-3">Produits à la une</h3>
        <button
          class="button is-primary ml-4"
          @click="isFilteredInSale = !isFilteredInSale"
        >
          {{ isFilteredInSale ? 'Afficher tout' : 'Afficher uniquement les promos' }}
        </button>
      </div>

      <div class="columns products is-multiline">
        <ProductItem
          v-for="product in filteredProducts"
          :key="product['@id']"
          :product="product"
          class="column is-one-quarter"
        />
      </div>
    </template>
  </section>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { axiosInstance } from '@/api/axios';
import ProductItem from '@/components/ProductItem.vue';

const featured = ref([]);
const imageUrl = 'https://picsum.photos/id/191/2246/749';
const title = 'Bienvenue !';
const isFilteredInSale = ref(false);

onMounted(async () => {
  const res = await axiosInstance.get('/products?featured=true');
  featured.value = res['hydra:member'];
});

const filteredProducts = computed(() => !isFilteredInSale.value ? featured.value : featured.value.filter((product) => product.inSale));
</script>

<style lang="scss">
.product { height: 100% }
</style>
