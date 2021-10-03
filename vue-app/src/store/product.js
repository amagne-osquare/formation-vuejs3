import { axiosInstance } from '@/api/axios';

export const product = {
  namespaced: true,
  state: () => ({
    items: [],
    item: null,
    variant: null,
  }),
  actions: {
    fetchAll: async ({ commit }) => {
      const res = await axiosInstance.get('/products');
      commit('SET_ITEMS', res['hydra:member']);
    },
    fetch: async ({ commit }, iri) => {
      const res = await axiosInstance.get(iri);
      commit('SET_ITEM', res);
    },
    setVariant: ({ commit }, variant) => commit('SET_VARIANT', variant),
  },
  mutations: {
    SET_ITEMS(state, items) {
      state.items = items;
    },
    SET_ITEM(state, item) {
      state.item = item;
    },
    SET_VARIANT(state, variant) {
      state.variant = variant;
    },
  }
};
