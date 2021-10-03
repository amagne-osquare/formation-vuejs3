import { createStore } from 'vuex';
import { product } from '@/store/product';
import { category } from '@/store/category';

export const store = createStore({
  modules: {
    product,
    category,
  }
})
