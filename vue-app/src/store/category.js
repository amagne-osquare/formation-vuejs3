import { axiosInstance } from '@/api/axios';

export const category = {
  namespaced: true,
  state: () => ({
    items: [],
    item: null,
  }),
  actions: {
    fetchAll: async ({ commit }) => {
      const res = await axiosInstance.get('/categories');
      commit('SET_ITEMS', res['hydra:member']);
    },
    fetch: async ({ commit }, iri) => {
      const res = await axiosInstance.get(iri);
      commit('SET_ITEM', res);
    },
  },
  mutations: {
    SET_ITEMS(state, items) {
      state.items = items;
    },
    SET_ITEM(state, item) {
      state.item = item;
    },
  }
};
