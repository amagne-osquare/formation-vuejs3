<template>
  Page category {{ $route.params.id }}
</template>

<script>
import { axiosInstance } from '@/api/axios';

export default {
  // data() {
  //   return {
  //     featured: [],
  //     imageUrl: 'https://picsum.photos/id/191/2246/749',
  //     isFilteredInSale: false,
  //     title: 'Bienvenue !',
  //   };
  // },
  // async created() {
  //   const res = await axiosInstance.get('/products?featured=true');
  //   this.featured = res['hydra:member'];
  // },
  // computed: {
  //   filteredProducts() {
  //     if (!this.isFilteredInSale) {
  //       return this.featured;
  //     }

  //     return this.featured.filter((product) => product.inSale);
  //   }
  // },
  // methods: {
  //   format(price) {
  //     return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price / 100);
  //   },
  // }
}
</script>