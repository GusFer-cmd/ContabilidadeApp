<script setup>
import { Link, router } from '@inertiajs/vue3';
import PrimaryMenu from '../Menu/Menu.vue'
import { reactive } from 'vue';
import ContainerLayout from '../X-Layout/ContainerLayout.vue';
import FormLayout from '../X-Layout/FormLayout.vue';
import AlertError from '../Alerts/AlertError.vue';
import AlertSuccess from '../Alerts/AlertSuccess.vue';

const props = defineProps({
    renter: Object
});

const form = reactive({
    name: props.renter.name,
    assigned_sex: props.renter.assigned_sex,
    telephone: props.renter.telephone,
    email: props.renter.email
});


let errors = reactive({
    errors: [],
    hasError: false,
});

let success = reactive({
    hasSuccess: false
});

function submitForm() {
    errors.hasError = false;
    success.hasSuccess = false;

    form._method= 'put';

    router.post(`/renter/update/${props.renter.id}`, form, {
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
        <ContainerLayout>
            <FormLayout>
                <AlertError :has-errors="errors.hasError" :errors="errors.errors" />
                <AlertSuccess :has-success="success.hasSuccess" />
                <form @submit.prevent="submitForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo do Locatário</label>
                        <input type="text" name="name" class="form-control" id="name" v-model="form.name" />
                    </div>
                    <div class="mb-3">
                        <label for="assigned_sex" class="form-label">Sexo atribuído no nascimento</label>
                        <select name="assigned_sex" id="assigned_sex" class="form-select"
                            v-model="form.assigned_sex" required>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Telefone do Locatário</label>
                        <input type="text" name="telephone" class="form-control" id="telephone" v-model="form.telephone" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail do Locatário</label>
                        <input type="text" name="email" class="form-control" id="email" v-model="form.email" />
                    </div>
                    <div class="d-flex justify-content-between">
                        <Link href="/renter/index" type="button" class="btn btn-outline-secondary">Voltar</Link>
                        <button type="submit" class="btn btn-primary">
                            Atualizar
                        </button>
                    </div>
                </form>
            </FormLayout>
        </ContainerLayout>
</template>