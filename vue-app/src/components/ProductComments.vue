<template>
  <div>
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
export default {
  props: {
    product: { type: Object, required: true },
  },
}
</script>
