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
        <div
          v-for="product in filteredProducts"
          :key="product['@id']"
          class="column is-one-quarter"
        >

          <div class="card product">
            <div class="card-image">
              <figure class="image is-4by3">
                <a href="#">
                  <img :src="product.imageUrl" :alt="product.name">
                </a>
              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <div class="is-flex is-justify-content-space-between is-align-items-baseline">
                    <p class="title is-4">
                      <a href="#">{{ product.name }}</a>
                    </p>

                    <div class="tags are-large is-pulled-right">
                      <span class="tag is-primary is-rounded">
                        {{ format(product.price) }}
                      </span>
                      <span v-if="product.inSale" class="tag is-warning is-rounded">PROMO</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="is-flex is-justify-content-space-between is-align-items-baseline">
                <div class="field is-grouped is-grouped-multiline">
                  <div
                    v-for="variant in product.variants"
                    :key="variant['@id']"
                    class="control"
                  >
                    <div class="tags has-addons">
                      <span class="tag" :style="{ backgroundColor: variant.value }"></span>
                      <span class="tag is-white">{{ variant.value }}</span>
                    </div>
                  </div>
                </div>
                <button class="button is-success" :disabled="0 === product.variants.length">Voir le produit</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </template>
  </section>
</template>

<script>
import { axiosInstance } from '@/api/axios';

export default {
  data() {
    return {
      featured: [],
      imageUrl: 'https://picsum.photos/id/191/2246/749',
      isFilteredInSale: false,
      title: 'Bienvenue !',
    };
  },
  async created() {
    const res = await axiosInstance.get('/products?featured=true');
    this.featured = res['hydra:member'];
  },
  computed: {
    filteredProducts() {
      if (!this.isFilteredInSale) {
        return this.featured;
      }

      return this.featured.filter((product) => product.inSale);
    }
  },
  methods: {
    format(price) {
      return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price / 100);
    },
  }
}
</script>

<style lang="scss">
.product { height: 100% }
</style>