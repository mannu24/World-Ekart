<template>
    <div class="px-2">
        <div class="ps-block--category">
            <a class="ps-block__overlay" :href="`${baseUrl}/${cat.slug}`"></a>
            <img :src="cat.image_path" v-if="cat.image_path" alt="martfury">
            <img :src="`${baseUrl}/themes/ekart/assets/images/not-found.jpg`" v-else alt="martfury">
            <p>{{ cat.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['cat'],
};
</script>
