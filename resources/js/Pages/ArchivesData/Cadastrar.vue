<script setup>
import { reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import PrimaryMenu from '../Menu/Menu.vue';
import FormLayout from '../X-Layout/FormLayout.vue';
import AlertErro from '../Alerts/AlertError.vue';
import { format } from "date-fns";

const props = defineProps({
    currentData: String
});

const form = reactive({
    title: '',
    description: '',
    create_date: props.currentData,
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
    form.create_date = format(new Date(form.create_date), 'yyyy-MM-dd HH:mm:ss');
    router.post("/archive/store", form, {
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
                <div class="d-flex justify-content-between">
                    <Link href="/dashboard" type="button" class="btn btn-outline-secondary">Voltar</Link>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </FormLayout>
</template>