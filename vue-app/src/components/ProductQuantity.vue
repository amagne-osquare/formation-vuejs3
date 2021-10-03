<template>
  <div>
    <p >Quantité : {{ qty }}</p>
    <div class="buttons ml-2">
      <button class="button is-danger" @click="decreaseQty">-</button>
      <button class="button is-success" @click="increaseQty">+</button>
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
  },
  computed: {
    total() {
      return Math.round(this.qty * this.product.price) / 100;
    },
  },
  methods: {
    increaseQty() {
      this.qty++;
    },
    decreaseQty() {
      if (0 < this.qty) {
        this.qty--;
      }
    },
  },
}
</script>
