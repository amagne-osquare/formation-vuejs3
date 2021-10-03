<template>
  <section class="hero is-primary" v-if="product">
    <div class="hero-body">
      <h1 class="title">{{ product.name }}</h1>
      <h2 class="subtitle">{{ product.category.name }}</h2>
    </div>
  </section>

  <section class="section" v-if="product">
    <nav class="breadcrumb" aria-label="breadcrumbs">
      <ul>
        <li><router-link :to="{ name: 'homepage' }">Accueil</router-link></li>
        <li><router-link :to="{ path: product.category['@id'] }">{{ product.category.name }}</router-link></li>
        <li class="is-active"><a href="#" aria-current="page">{{ product.name }}</a></li>
      </ul>
    </nav>

    <div class="box columns" id="product">
      <div class="column is-one-third">
        <figure class="image is-4by3">
          <img :src="product.imageUrl" :alt="product.name">
        </figure>
      </div>
      <div class="column is-two-thirds">
        <div class="is-flex is-justify-content-space-between is-align-items-baseline">
          <p class="title">{{ product.name }}</p>
          <div class="tags are-large">
            <span class="tag is-primary is-rounded">
              {{ format(product.price) }}
            </span>
            <span v-if="product.inSale" class="tag is-warning is-rounded">PROMO</span>
          </div>
        </div>

        <div class="is-flex is-justify-content-space-between is-align-items-baseline">
          <div
            v-if="product.variants.length"
            class="select is-rounded is-medium is-warning"
          >
            <select name="variant" @change="setVariant($event.target.value)">
              <option>Couleur...</option>
              <option
                v-for="variant in product.variants"
                :key="variant"
                :value="variant"
              >{{ variant.value }}</option>
            </select>
          </div>

          <div class="is-flex is-align-items-baseline">
            <p >Quantité : {{ qty }}</p>
            <div class="buttons ml-2">
              <button class="button is-danger" @click="decreaseQty">-</button>
              <button class="button is-success" @click="increaseQty">+</button>
            </div>
            <p class="has-text-weight-bold ml-2">Total : {{ total }} €</p>
          </div>
        </div>

        <div class="tabs is-boxed is-medium">
          <ul>
            <li
              :class="{ 'is-active': 'details' === activeTab }"
              @click="activeTab = 'details'"
            ><a>Détails</a></li>
            <li
              v-if="product.comments.length"
              :class="{ 'is-active': 'comments' === activeTab }"
              @click="activeTab = 'comments'"
            ><a>Commentaires</a></li>
          </ul>
        </div>
        <div class="content" v-if="'details' === activeTab" v-html="product.details" />
        <div class="content" v-else-if="product.comments.length">
          <ul>
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
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { axiosInstance } from '@/api/axios';

export default {
  data() {
    return {
      activeTab: 'details',
      product: null,
      qty: 0,
      variant: null,
    };
  },
  props: {
    '@id': { type: String, required: true },
  },
  computed: {
    total() {
      return Math.round(this.qty * this.product.price) / 100;
    },
  },
  async created() {
    this.product = await axiosInstance.get(this['@id']);
  },
  methods: {
    format() {
      return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(this.product.price / 100);
    },
    increaseQty() {
      this.qty++;
    },
    decreaseQty() {
      if (0 < this.qty) {
        this.qty--;
      }
    },
    setVariant(value) {
      this.variant = value;
    }
  },
}
</script>
