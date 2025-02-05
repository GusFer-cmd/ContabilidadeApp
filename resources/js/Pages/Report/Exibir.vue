<script setup>
import Menu from '../Menu/Menu.vue';
import ContainerLayout from '../X-Layout/ContainerLayout.vue';
import SecondaryCard from '../Card/SecondaryCard.vue';

const props = defineProps({
    cards: Object
});

</script>

<template>
      <div class="main">
        <Menu />
        <ContainerLayout>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 g-4">
                <div v-for="archive in props.cards" :key="archive.id" class="col mb-4">
                    <SecondaryCard :card="archive"/>
                </div>
            </div>
        </ContainerLayout>
    </div>
</template>

<style scoped>

.main {
    background-color: #495E57;
    height: 100vh;
    margin: 0;
}
</style>