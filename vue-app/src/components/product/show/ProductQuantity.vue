<template>
  <div>
    <p >Quantité : {{ qty }} (max : {{ qtyMax }})</p>
    <div class="buttons ml-2">
      <button class="button is-danger" :disabled="qty <= 0" @click="decreaseQty">-</button>
      <button class="button is-success" :disabled="qty >= qtyMax" @click="increaseQty">+</button>
    </div>
    <p class="has-text-weight-bold ml-2">Total : {{ format(total) }}</p>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useStore } from 'vuex';
import { format } from '@/composables/useFormatPrice';

const store = useStore();
const qty = ref(0);

const product = computed(() => store.state.product.item);
const qtyMax = computed(() => store.getters['product/qtyMax']);
const total = computed(() => Math.round(qty.value * product.value.price));

const increaseQty = () => qty.value = qty.value < qtyMax.value ? qty.value + 1 : qty.value;
const decreaseQty = () => qty.value = 0 < qty.value ? qty.value - 1 : qty.value;
</script>
