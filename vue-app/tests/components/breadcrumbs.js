import { render, screen } from '@testing-library/vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { router } from '@/router';

test('should see the homepage link and current link without parent', async () => {
  render(Breadcrumbs, {
    props: {
      current: 'Foo',
    },
    global: {
      plugins: [router]
    },
  });
  expect(screen.queryByText('Accueil')).toBeTruthy();
  expect(screen.queryByText('Foo')).toBeTruthy();
});

test('should see the homepage link, the parent link and the current link', async () => {
  render(Breadcrumbs, {
    props: {
      current: 'Foo',
      parent: { name: 'Bar', '@id': '' },
    },
    global: {
      plugins: [router]
    },
  });
  expect(screen.queryByText('Accueil')).toBeTruthy();
  expect(screen.queryByText('Bar')).toBeTruthy();
  expect(screen.queryByText('Foo')).toBeTruthy();
})
