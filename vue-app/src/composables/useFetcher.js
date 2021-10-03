import { ref, watch } from 'vue';
import { axiosInstance } from '@/api/axios';

export const useFetcher = (id) => {
  const item = ref(null);
  watch(
    id,
    async () => {
      item.value = await axiosInstance.get(id.value);
    },
    { immediate: true },
  );

  return item;
}

