<template>
  <div>
    <p >Quantité : {{ qty }} (max : {{ qtyMax }})</p>
    <div class="buttons ml-2">
      <button class="button is-danger" :disabled="qty <= 0" @click="decreaseQty">-</button>
      <button class="button is-success" :disabled="qty >= qtyMax" @click="increaseQty">+</button>
    </div>
    <p class="has-text-weight-bold ml-2">Total : {{ total }} €</p>
  </div>
</template>

<script>
import { ref, toRefs, computed } from 'vue';

export default {
  props: {
    product: { type: Object, required: true },
    qtyMax: { type: Number, default: 0 },
  },
  setup(props) {
    const { product, qtyMax } = toRefs(props);
    const qty = ref(0);
    const total = computed(() => Math.round(qty.value * product.value.price) / 100);
    const increaseQty = () => qty.value = qty.value < qtyMax.value ? qty.value + 1 : qty.value;
    const decreaseQty = () => qty.value = 0 < qty.value ? qty.value - 1 : qty.value;

    return {
      decreaseQty,
      increaseQty,
      qty,
      qtyMax,
      total,
    }
  },
}
</script>
