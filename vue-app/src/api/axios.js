import axios from 'axios';

const TYPE_JSONLD = 'application/ld+json';
export const axiosInstance = axios.create();
axiosInstance.interceptors.request.use((request) => {
  request.headers['Content-Type'] = TYPE_JSONLD;
  request.baseURL = 'https://localhost/';

  return request;
});

axiosInstance.interceptors.response.use(
  (response) => response.data ? response.data : response,
);