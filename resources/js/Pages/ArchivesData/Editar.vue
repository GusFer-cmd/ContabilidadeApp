<script setup>
import { reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import PrimaryMenu from '../Menu/Menu.vue';
import FormLayout from '../X-Layout/FormLayout.vue';
import AlertErro from '../Alerts/AlertError.vue';
import { format } from "date-fns";

const props = defineProps({
    archive: Object
});

const form = reactive({
    title: props.archive.title,
    description: props.archive.description,
    create_date: props.archive.create_date,
});

let errors = reactive({
    errors: [],
    hasError: false,
});

let success = reactive({
    hasSuccess: false
});

function submitForm(){
    errors.hasError = false;
    success.hasSuccess = false;

    form._method = 'put';

    router.post(`/archive/update/${props.archive.id}`, form, {
        onError: (error) => {
            errors.errors = error;
            errors.hasError = true;
        },
        onSuccess: () => {
            success.hasSuccess = true;
        }
    });
}

</script>

<template>
    <PrimaryMenu />
        <FormLayout>
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="Title" class="form-label">Título</label>
                    <input type="text" name="title" class="form-control" id="title" v-model="form.title">
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Descrição</label>
                    <textarea type="description" name="description" class="form-control" id="description" v-model="form.description"></textarea>
                </div>
                <div class="mb-3">
                <input type="text" hidden name="create_date" class="form-control" id="create_date"
                    v-model="form.create_date" />
                </div>
                <div class="d-flex gap-2">
                    <Link href="/archive/index" type="button" class="btn btn-outline-secondary">Voltar</Link>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </FormLayout>
</template>