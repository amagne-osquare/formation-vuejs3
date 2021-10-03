<template>
  <div>
    <div class="card product">
      <div class="card-image">
        <figure class="image is-4by3">
          <router-link :to="product['@id']">
            <img :src="product.imageUrl" :alt="product.name">
          </router-link>
        </figure>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p class="title is-4">
              <router-link :to="product['@id']">{{ product.name }}</router-link>
            </p>

            <div class="tags are-large is-pulled-right">
              <span class="tag is-primary is-rounded">
                {{ format(product.price) }}
              </span>
              <span v-if="product.inSale" class="tag is-warning is-rounded">PROMO</span>
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
</template>

<script setup>
import { format } from '@/composables/useFormatPrice';

defineProps({
  product: { type: Object, required: true },
});
</script>
