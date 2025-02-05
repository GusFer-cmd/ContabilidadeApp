<script setup>

const props = defineProps({
    errors: Array,
    hasErrors: Boolean
});

</script>

<template>
    <div v-if="hasErrors" class="alert alert-danger p-2 m-0">
        <ul>
            <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
    </div>
</template>