<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="custom-font p-3">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-10 col-sm-10 col-12">
                <div class="d-flex justify-content-center mt-5 mb-5">
                    <Link href="/">
                        <img :src="'images/salary-primary.png'" alt="25" width="250">
                    </Link>
                </div>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .custom-font {
        font-family: "Roboto", serif;
        font-weight: 700;
        font-style: normal;
    }
</style>
