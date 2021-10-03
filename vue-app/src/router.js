import { createRouter, createWebHistory } from 'vue-router';
import Category from '@/views/Category.vue';
import Home from '@/views/Home.vue';

const routes = [
  { path: '/', component: Home, name: 'homepage' },
  {
    path: '/categories/:id',
    component: Category,
    name: 'category',
    props: (route) => ({
      ...route.params,
      '@id': `/categories/${route.params.id}`,
    }),
  },
];

export const router = createRouter({
  history: createWebHistory(),
  routes,
})
