<script>
import { h } from 'vue';

export default {
  props: {
    product: { type: Object, required: true },
  },
  render() {
    return h(
      'div',
      {},
      this.$props.product.details,
    )
  },
}
</script>
