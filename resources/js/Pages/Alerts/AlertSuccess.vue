<script setup>

const props = defineProps({
    hasSuccess: Boolean
});

</script>

<template>
    <div v-if="hasSuccess" class="alert alert-success p-2 m-0">
        <ul>
            <li>Sucesso!</li>
        </ul>
    </div>
</template>