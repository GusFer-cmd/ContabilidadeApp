<script setup>
import XLayout from './X-Layout/X-Layout.vue';
import AlertError from './Alerts/AlertError.vue';
import { reactive } from 'vue';
import { Link } from '@inertiajs/vue3';

let errors = reactive({
    errors: [],
    hasError: false
});

</script>

<template>
    <XLayout>
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-10">
            <div class="alert border-secondary bg-body-tertiary p-4 m-0">
                <AlertError :has-errors="errors.hasError" :errors="errors.errors"/>
                <h1 class="text-center">Contabilidade</h1>
                <div class=" mt-3 d-grid">
                    <Link href="/dashboard" type="submit" class="btn btn-primary">
                        Pagina Inicial
                    </Link>
                </div>
            </div>
            </div>
        </div>
    </XLayout>
</template>

<style scoped>
    .custom-font {
        font-family: "Open Sans", serif;
        font-style: normal;
    }
</style>

