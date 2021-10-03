<template>
  <div v-if="product.variants.length">
    <select name="variant" @change="setVariant">
      <option value="">Couleur...</option>
      <option
        v-for="variant in product.variants"
        :key="variant"
        :value="variant['@id']"
      >{{ variant.value }}</option>
    </select>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const product = computed(() => store.state.product.item);
const variant = computed(() => store.state.product.variant);

const setVariant = (value) => {
  store.dispatch('product/setVariant', value.target.value);
}
</script>
