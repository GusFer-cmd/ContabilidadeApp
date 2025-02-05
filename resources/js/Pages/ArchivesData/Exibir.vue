<script setup>
import { Link, router } from '@inertiajs/vue3';
import PrimaryMenu from '../Menu/Menu.vue'
import { ref, computed } from 'vue';
import { format } from "date-fns";

const props = defineProps({
    archives: Object
});

// Configurações de paginação
const currentPage = ref(1);
const itemsPerPage = 5; 

// Computed para calcular quais usuários exibir na página atual
const paginatedArchives = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.archives.slice(start, end);
});

// Total de páginas
const totalPages = computed(() => {
    return Math.ceil(props.archives.length / itemsPerPage);
});

// Funções de navegação
function goToPage(page) {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
}

function deleteArchive(id) {
    if (confirm('Tem certeza que deseja excluir esse evento?')) {
        router.post('/archive/delete/' + id, {_method: 'delete'});
    }
}

</script>

<template>
    <PrimaryMenu />
        <div class="container-fluid mt-3">
            <h2 class="text-white">Gerenciar Arquivos:</h2>
            <div class="d-flex justify-content-start mb-3">
                <Link href="/archive/create" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Novo Arquivo
                </Link>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">TITULO</th>
                            <th scope="col">DESCRIÇÃO</th>
                            <th scope="col">DATA DE CRIAÇÃO</th>
                            <th scope="col">OPÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="archive in paginatedArchives" :key="archive.id">
                            <td>{{ archive.title }}</td>
                            <td>{{ archive.description }}</td>
                            <td>{{ format(new Date(archive.create_date), 'dd/MM/yyyy HH:mm') }}</td>
                            <td>
                                <div>
                                    <Link :href="`/archive/edit/${archive.id}`" class="btn btn-secondary">
                                        <i class="bi bi-pencil"></i>
                                    </Link>
                                    <button @click="deleteArchive(archive.id)" class="btn btn-danger ms-2">
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
        </div>
</template>