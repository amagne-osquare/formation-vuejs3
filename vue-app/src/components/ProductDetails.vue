<template>
  <div>{{ product.details }}</div>
</template>

<script setup>
defineProps({
  product: { type: Object, required: true },
});
</script>
