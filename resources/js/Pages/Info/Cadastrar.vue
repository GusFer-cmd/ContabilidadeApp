<script setup>
import { Link, router } from "@inertiajs/vue3";
import { reactive } from 'vue';
import AlertError from '../Alerts/AlertError.vue'
import AlertSucces from '../Alerts/AlertSuccess.vue'
import FormLayout from '../X-Layout/FormLayout.vue';
import Menu from '../Menu/Menu.vue';


const props = defineProps({
    card: Object,
    renters: Object
});

const form = reactive({
    renter_id: "",
    card_id: props.card.id,
    payment_date: "",
    payment_value: ""
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
    router.post("/info/store/", form, {
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
    <Menu />
    <h5 class="text-white text-center mt-3"><i class="fs-4 bi bi-house-gear"></i> Locação: {{ props.card.title }}</h5>
    <FormLayout>
        <AlertError :has-errors="errors.hasError" :errors="errors.errors"/>
        <AlertSucces :has-success="success.hasSuccess"/>
            <form @submit.prevent="submitForm()">
                <div class="mb-3">
                    <label class="form-label">Locatário</label>
                    <select name="renter_id" class="form-select" id="renter_id" v-model="form.renter_id">
                        <option v-for="renter in props.renters" :key="renter.id" :value="renter.id"> {{ renter.name }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="card_id" class="form-label">Locação Correspondente</label>
                    <input type="text" name="card_id" class="form-control" id="card_id" :value="props.card.title" disabled/>
                </div>
                <div class="mb-3">
                    <label for="payment_date" class="form-label">Data do Pagamento</label>
                    <input type="datetime-local" name="payment_date" class="form-control" id="payment_date"
                        v-model="form.payment_date" />
                </div>
                <div class="mb-3">
                    <label for="payment_value" class="form-label">Valor do Pagamento</label>
                    <input type="decimal" name="payment_value" class="form-control" id="payment_value" v-model="form.payment_value" />
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <Link :href="`/manager/archive/${props.card.id}`" class="btn btn-outline-secondary">
                        Voltar
                    </Link>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
    </FormLayout>
</template>