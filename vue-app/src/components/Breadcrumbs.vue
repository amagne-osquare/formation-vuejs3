<template>
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li><router-link :to="{ name: 'homepage' }">Accueil</router-link></li>
      <li v-if="parent">
        <router-link :to="{ path: parent['@id'] }">{{ parent.name }}</router-link>
      </li>
      <li class="is-active"><a href="#" aria-current="page">{{ current }}</a></li>
    </ul>
  </nav>
</template>

<script setup>
defineProps({
  parent: { type: Object },
  current: { type: String, required: true },
});
</script>
