<template>
  <div>{{ product.details }}</div>
</template>

<script setup>
import { useStore } from 'vuex';
import { computed } from 'vue';

const store = useStore();
const product = computed(() => store.state.product.item);
</script>
