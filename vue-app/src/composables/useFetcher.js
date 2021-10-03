import { ref, watch } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
export const useFetcher = (id) => {
  const item = ref(null);
  watch(
    id,
    async () => {
      // item.value = await axiosInstance.get(id.value);
      await store.dispatch('category/fetch', props['@id']);
    },
    { immediate: true },
  );

  return item;
};
