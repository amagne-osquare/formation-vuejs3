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
          <product-variants
            v-if="product.variants.length"
            :product="product"
            class="select is-rounded is-medium is-warning"
            @setQtyMax="qtyMax = $event"
          />

          <product-quantity
            class="is-flex is-align-items-baseline"
            :product="product"
            :qty-max="qtyMax"
          />
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
          <component class="content" :is="activeTab" :product="product"/>
        </keep-alive>
      </div>
    </div>
  </section>
</template>

<script>
import { axiosInstance } from '@/api/axios';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import ProductMixin from '@/mixins/ProductMixin';
import ProductComments from '@/components/ProductComments.vue';
import ProductDetails from '@/components/ProductDetails.vue';
import ProductQuantity from '@/components/ProductQuantity.vue';
import ProductVariants from '@/components/ProductVariants.vue';

export default {
  data() {
    return {
      activeTab: 'product-details',
      product: null,
      qtyMax: 0,
    };
  },
  props: {
    '@id': { type: String, required: true },
  },
  components: {
    Breadcrumbs,
    ProductComments,
    ProductDetails,
    ProductQuantity,
    ProductVariants,
  },
  mixins: [ProductMixin],
  computed: {
    tabs() {
      const tabs = [{ label: 'Détails', component: 'product-details' }];
      if (0 < this.product.comments.length) {
        tabs.push({ label: 'Commentaires', component: 'product-comments' });
      }

      return tabs;
    },
  },
  watch: {
    '@id': {
      async handler() {
        this.product = await axiosInstance.get(this['@id']);
      },
      immediate: true,
    },
  },
}
</script>
