import { createRouter, createWebHistory } from 'vue-router';
import Category from '@/views/Category.vue';
import Home from '@/views/Home.vue';
import Product from '@/views/Product.vue';

const idToIri = (route, basename) => ({
  '@id': `/${basename}/${route.params.id}`,
});

const routes = [
  { path: '/', component: Home, name: 'homepage' },
  {
    path: '/categories/:id',
    component: Category,
    name: 'category',
    props: (route) => idToIri(route, 'categories'),
  },
  {
    path: '/products/:id',
    component: Product,
    name: 'product',
    props: (route) => idToIri(route, 'products'),
  },
];

export const router = createRouter({
  history: createWebHistory(),
  routes,
})
