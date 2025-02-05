<script setup>
import { Link, router } from '@inertiajs/vue3';
import { format } from "date-fns";

const props = defineProps({
  card: Object
});

const createDate = format(new Date(props.card.create_date), 'dd/MM/yyyy HH:mm')

function redirect(id)
{
  router.get("/manager/archive/" + id);
}

</script>

<template>
    <div class="card pb-2">
        <img class="card-img-top" :src="'images/card-bg-2.png'" alt="Card image">
        <div class="card-body">
            <h4 class="card-title">{{ props.card.title }}</h4>
            <p class="card-text">{{ props.card.description }}</p>
            <button @click="redirect(props.card.id)" class="btn custom-btn text-white">Gerenciar</button>
        </div>
        <div class="card-footer text-body-secondary">
          Criado: {{ createDate }}
        </div>
    </div>
</template>

<style scoped>
.card {
  max-width: 395px; 
  width: 100%; 
  border-radius: 10px; 
}

.card-text {
  font-size: 0.9rem;
}

.custom-btn {
    background: #495E57;
}

.custom-btn:hover {
  background: #3e504b;
  color: white;
  transition: background-color 0.3s ease;
}

</style>