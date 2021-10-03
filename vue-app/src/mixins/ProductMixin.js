export default {
  methods: {
    format(price) {
      return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price / 100);
    },
  },
}