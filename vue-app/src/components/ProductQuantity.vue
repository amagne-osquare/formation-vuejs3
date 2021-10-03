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
export default {
  data() {
    return {
      qty: 0,
    };
  },
  props: {
    product: { type: Object, required: true },
    qtyMax: { type: Number, default: 0 },
  },
  computed: {
    total() {
      return Math.round(this.qty * this.product.price) / 100;
    },
  },
  methods: {
    increaseQty() {
      if (this.qty < this.qtyMax) {
        this.qty++;
      }
    },
    decreaseQty() {
      if (0 < this.qty) {
        this.qty--;
      }
    },
  },
}
</script>
