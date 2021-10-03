<template>
  <form class="box mt-2" @submit.prevent="submit" @reset="cancel">
    <div class="notification is-danger" v-if="error">{{ error }}</div>
    <div class="field">
      <label class="label">Nom</label>
      <div class="control">
        <input class="input" type="text" placeholder="John Doe" v-model="comment.author">
      </div>
    </div>

    <div class="control is-flex">
      <label class="label">Votre note</label>
      <div class="ml-2">
        <font-awesome-icon
          icon="star"
          v-for="i in [1, 2, 3, 4, 5]" :key="i"
          :class="['radio', { 'has-text-warning': comment.note >= i }]"
          :value="i"
          @click="comment.note = i"
        ></font-awesome-icon>
      </div>
    </div>

    <div class="field">
      <label class="label">Commentaire</label>
      <div class="control">
        <textarea class="textarea" placeholder="Votre message..." v-model="comment.comment"></textarea>
      </div>
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link" type="submit">Envoyer</button>
      </div>
      <div class="control">
        <button class="button is-link is-light" type="reset">Annuler</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { axiosInstance } from '@/api/axios';
import { ref, reactive } from 'vue';

const props = defineProps({
  product: { type: Object, required: true },
});

const emits = defineEmits(['hide']);

const emptyComment = { comment: '', note: 5, author: '', product: props.product['@id'] };
let comment = reactive(emptyComment);
const error = ref(null);

const submit = async () => {
  error.value = '';
  if (!comment.author || !comment.comment) {
    error.value = 'Merci de remplir tous les champs';
    return;
  }

  try {
    await axiosInstance.post('/product_comments', comment);
    emits('hide');
  } catch (e) {
    error.value = e;
  }
};

const cancel = () => {
  comment = emptyComment;
  emits('hide');
};
</script>
