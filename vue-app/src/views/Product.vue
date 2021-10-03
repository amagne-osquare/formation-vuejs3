<template>
  <section class="hero is-primary" v-if="product">
    <div class="hero-body">
      <h1 class="title">{{ product.name }}</h1>
      <h2 class="subtitle">{{ product.category.name }}</h2>
    </div>
  </section>

  <section class="section" v-if="product">
    <breadcrumbs :parent="product.category" :current="product.name" />

    <div class="box columns" id="product">
      <div class="column is-one-third">
        <figure class="image is-4by3">
          <img :src="product.imageUrl" :alt="product.name">
        </figure>
      </div>
      <div class="column is-two-thirds">
        <div class="is-flex is-justify-content-space-between is-align-items-baseline">
          <p class="title">{{ product.name }}</p>
          <div class="tags are-large">
            <span class="tag is-primary is-rounded">
              {{ format(product.price) }}
            </span>
            <span v-if="product.inSale" class="tag is-warning is-rounded">PROMO</span>
          </div>
        </div>

        <div class="is-flex is-justify-content-space-between is-align-items-baseline">
          <product-variants class="select is-rounded is-medium is-warning" />
          <product-quantity class="is-flex is-align-items-baseline" />
        </div>

        <div class="tabs is-boxed is-medium">
          <ul>
            <li
              v-for="tab in tabs" :key="tab.component"
              :class="{ 'is-active': tab.component === activeTab }"
              @click="activeTab = tab.component"
            ><a>{{ tab.label }}</a></li>
          </ul>
        </div>
        <keep-alive>
          <component class="content" :is="activeTab" />
        </keep-alive>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, shallowRef, watch } from 'vue';
import { useStore } from 'vuex';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import ProductComments from '@/components/product/show/ProductComments.vue';
import ProductDetails from '@/components/product/show/ProductDetails.vue';
import ProductQuantity from '@/components/product/show/ProductQuantity.vue';
import ProductVariants from '@/components/product/show/ProductVariants.vue';
import { format } from '@/composables/useFormatPrice';

const store = useStore();
const props = defineProps({
  '@id': { type: String, required: true },
});
const product = computed(() => store.state.product.item);

watch(
  props,
  () => {
    store.dispatch('product/fetch', props['@id']);
  },
  { immediate: true },
);

const activeTab = shallowRef(ProductDetails);

const tabs = computed(() => {
  const tabs = [{ label: 'Détails', component: ProductDetails }];
  if (0 < product.value.comments.length) {
    tabs.push({ label: 'Commentaires', component: ProductComments });
  }

  return tabs;
});
</script>
