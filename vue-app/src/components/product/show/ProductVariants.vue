<template>
  <div v-if="product.variants.length">
    <Selector :options="product.variants" @change="setVariant">
      <template #default>
        <option value="">Couleur...</option>
      </template>
      <template #option="{ option }">
        {{ option.value }}
      </template>
    </Selector>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';
import Selector from '@/components/Selector.vue';

const store = useStore();
const product = computed(() => store.state.product.item);
const variant = computed(() => store.state.product.variant);

const setVariant = (el) => store.dispatch('product/setVariant', el.target.value);
</script>
