<template>
    <section class="section">
        <h1 class="title has-text-primary">{{ title }}</h1>

        <figure class="image is-3by1">
            <img :src="imageUrl" />
        </figure>

        <hr />

        <!-- insert featured products -->
    </section>
</template>

<script>
export default {
    data() {
        return {
            title: 'Bienvenue !',
            imageUrl: 'https://picsum.photos/id/191/2246/749'
        };
    },
}
</script>
