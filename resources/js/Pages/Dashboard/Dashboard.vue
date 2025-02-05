<script setup>
import Menu from '../Menu/Menu.vue';
import ContainerLayout from '../X-Layout/ContainerLayout.vue';
import PrimaryCard from '../Card/PrimaryCard.vue';

const props = defineProps({
    archives: Object
});

</script>

<template>
    <div class="main">
        <Menu />
        <ContainerLayout>
            <div v-if="props.archives.length === 0" class="col">
                <div class="card text-center border-secondary mt-2">
                    <div class="card-body">
                        <p class="fw-bold text-black">Nenhum arquivo cadastrado!</p>
                    </div>
                </div>
            </div> 
            <div v-else class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 g-4">
                <div v-for="archive in props.archives" :key="archive.id" class="col mb-4">
                    <PrimaryCard :card="archive"/>
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