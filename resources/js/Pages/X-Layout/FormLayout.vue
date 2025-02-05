<script setup>

</script>

<template>
     <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center d-flex flex-column">
                            <i class="bi bi-clipboard"></i>Preencha os dados
                        </h3>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
     </div>
</template>