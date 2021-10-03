<template>
  <div>
    <button class="button is-primary is-light" @click="showForm = !showForm">
      <font-awesome-icon :icon="showForm ? 'comment-slash' : 'comment'" />
      <span class="ml-2">{{ showForm ? 'Cacher' : 'Afficher' }} le formulaire de commentaire</span>
    </button>
    <product-comments-new
      v-show="showForm"
      :product="product"
      @hide="showForm = false"
    />
    <hr />
    <article
      v-for="comment in product.comments"
      :key="comment['@id']"
      class="message is-dark"
    >
      <div class="message-header is-flex">
        <p>{{ comment.date }}, par {{ comment.author }}</p>
        <p>({{ comment.note }}/5)</p>
      </div>
      <div class="message-body">
        {{ comment.comment }}
      </div>
    </article>
  </div>
</template>

<script>
import ProductCommentsNew from '@/components/ProductCommentsNew.vue';

export default {
  components: {
    ProductCommentsNew,
  },
  props: {
    product: { type: Object, required: true },
  },
  data() {
    return {
      showForm: true,
    };
  },
}
</script>
