<script setup>
import ContainerLayout from '../X-Layout/ContainerLayout.vue';
import Menu from '../Menu/Menu.vue'
import { Link, router } from "@inertiajs/vue3";
import { format } from "date-fns";
import { ref, computed } from 'vue';

const props = defineProps({
    archive: Object,
    infos: Object
});

// Configurações de paginação
const currentPage = ref(1);
const itemsPerPage = 5; 

// Computed para calcular quais usuários exibir na página atual
const paginatedInfo = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.infos.slice(start, end);
});

// Total de páginas
const totalPages = computed(() => {
    return Math.ceil(props.infos.length / itemsPerPage);
});

// Funções de navegação
function goToPage(page) {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
}

function editInfo(id) {
    router.get('/info/edit/' + id);
}

function deleteInfo(id) {
    if (confirm('Tem certeza que deseja excluir essa informação?')){
        router.post('/info/delete/' + id, {_method: 'delete'});  
    }
}

</script>

<template>
    <Menu />
    <ContainerLayout>
        <h2 class="text-white">Gerenciamento</h2>
        <h5 class="text-white"><i class="fs-4 bi bi-house-gear"></i> Locação: {{ props.archive.title }}</h5>
        <div class="my-3 d-flex align-items-center gap-3">
            <Link href="/dashboard" class="btn btn-secondary">
                <i class="fs-6 bi bi-arrow-left-square"> Voltar</i>
            </Link>
            <Link :href="`/info/create/${props.archive.id}`" class="custom-btn btn btn-primary">
                <i class="fs-6 bi bi-cash-coin"> Adicionar</i>
            </Link>
        </div>
        <div class="custom-bg card text-white rounded">
            <div class="custom-header card-header text-center">
                <h4>Informações</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Locatário</th>
                                <th scope="col">Data do Pagamento</th>
                                <th scope="col">Valor do Pagamento</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="info in paginatedInfo" :key="info.id">
                                <td>{{ info.renter.name }}</td>
                                <td>{{ format(new Date(info.payment_date), 'dd/MM/yyyy - HH:mm') }}</td>
                                <td>{{ info.payment_value }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button @click="editInfo(info.id)" class="btn btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button @click="deleteInfo(info.id)" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination mt-3">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <button class="page-link" @click="goToPage(currentPage - 1)">
                        Anterior
                    </button>
                </li>

                <li
                    v-for="page in totalPages"
                    :key="page"
                    class="page-item"
                    :class="{ active: currentPage === page }"
                >
                    <button class="page-link" @click="goToPage(page)">{{ page }}</button>
                </li>
                    
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <button class="page-link" @click="goToPage(currentPage + 1)">
                        Próximo
                    </button>
                </li>
            </ul>
        </nav>
    </ContainerLayout>
</template>


<style scoped>
.custom-bg{
    background-color: #F5F7F8;
}

.custom-btn{
    color: #495E57;
    background-color: #F4CE14;
    border: #F5F7F8;
}

.custom-btn:hover{
    color: #F4CE14;
    background-color: #45474B;
    border: #F5F7F8;
}

.custom-header{
    background-color: #45474B;
}

</style>