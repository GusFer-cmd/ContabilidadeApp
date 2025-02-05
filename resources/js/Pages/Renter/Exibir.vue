<script setup>
import { Link, router } from '@inertiajs/vue3';
import PrimaryMenu from '../Menu/Menu.vue'
import { ref, computed } from 'vue';
import { format } from "date-fns";
import ContainerLayout from '../X-Layout/ContainerLayout.vue';

const props = defineProps({
    renters: Object,
    infos: Object
});

// Configurações de paginação
const currentPage = ref(1);
const itemsPerPage = 5; 

// Computed para calcular quais usuários exibir na página atual
const paginatedRenters = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.renters.slice(start, end);
});

// Total de páginas
const totalPages = computed(() => {
    return Math.ceil(props.renters.length / itemsPerPage);
});

// Funções de navegação
function goToPage(page) {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
}

function deleteRenter(id) {
    const isLinked = props.infos.some(info => info.renter_id === id);

    if (isLinked) {
        alert('Este locatário está vinculado a um arquivo e não pode ser excluído.');
        return;
    }

    if (confirm('Tem certeza que deseja excluir esse Locatário?')) {
        router.post('/renter/delete/' + id, {_method: 'delete'});
    }
}

</script>

<template>
    <PrimaryMenu />
        <ContainerLayout>
            <h2 class="text-white">Gerenciar Locatários:</h2>
                <div class="d-flex justify-content-start mb-3">
                    <Link href="/renter/create" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Novo Locatário
                    </Link>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="renter in paginatedRenters" :key="renter.id">
                                <td>{{ renter.name }}</td>
                                <td>{{ renter.assigned_sex }}</td>
                                <td>{{ renter.telephone }}</td>
                                <td>{{ renter.email }}</td>
                                <td>
                                    <div>
                                        <Link :href="`/renter/edit/${renter.id}`" class="btn btn-secondary">
                                            <i class="bi bi-pencil"></i>
                                        </Link>
                                        <button @click="deleteRenter(renter.id)" class="btn btn-danger ms-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                <ul class="pagination">
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