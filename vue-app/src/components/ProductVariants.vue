<template>
  <div>
    <select name="variant" @change="setVariant($event.target.value)">
      <option>Couleur...</option>
      <option
        v-for="variant in product.variants"
        :key="variant"
        :value="variant['@id']"
      >{{ variant.value }}</option>
    </select>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  product: { type: Object, required: true },
});

const emit = defineEmits(['setQtyMax']);
const variant = ref();

const setVariant = (value) => {
  variant.value = value;
  emit('setQtyMax', props.product.variants.find((el) => el['@id'] === value).qtyInStock);
}
</script>
