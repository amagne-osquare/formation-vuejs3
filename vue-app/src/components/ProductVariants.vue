<template>
  <div>
    <select name="variant" @change="setVariant($event.target.value)">
      <option>Couleur...</option>
      <option
        v-for="variant in product.variants"
        :key="variant"
        :value="variant"
      >{{ variant.value }}</option>
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      variant: null,
    };
  },
  props: {
    product: { type: Object, required: true },
  },
  methods: {
    setVariant(value) {
      this.variant = value;
    }
  },
}
</script>
