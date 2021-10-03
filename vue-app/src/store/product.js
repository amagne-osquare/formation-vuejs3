import { axiosInstance } from '@/api/axios';

export const product = {
  namespaced: true,
  state: () => ({
    items: [],
    item: null,
    variant: null,
  }),
  getters: {
    qtyMax: (state) => {
      if (!state.variant) {
        return 0;
      }
      return state.item.variants.find((el) => el['@id'] === state.variant).qtyInStock;
    },
  },
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
    addComment: async ({ commit, dispatch, state }, comment) => {
      comment.product = state.item['@id'];
      await axiosInstance.post('/product_comments', comment);
      dispatch('fetch', comment.product);
    }
  },
  mutations: {
    SET_ITEMS(state, items) {
      state.items = items;
    },
    SET_ITEM(state, item) {
      state.item = item;
      state.variant = null;
    },
    SET_VARIANT(state, variant) {
      state.variant = variant;
    },
  }
};
