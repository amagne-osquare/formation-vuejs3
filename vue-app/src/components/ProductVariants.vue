<template>
  <div>
    <select name="variant" @change="setVariant($event.target.value)">
      <option>Couleur...</option>
      <option
        v-for="variant in variants"
        :key="variant"
        :value="variant['@id']"
      >{{ variant.value }}</option>
    </select>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    product: { type: Object, required: true },
  },
  setup(props, { emit }) {
    const variant = ref();

    const setVariant = (value) => {
      variant.value = value;
      emit('setQtyMax', props.product.variants.find((el) => el['@id'] === value).qtyInStock);
    }

    return {
      setVariant,
      variants: props.product.variants,
    };
  }
}
</script>
