<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
  <nav class="navbar navbar-expand-lg custom-navbar px-2 py-2">
    <Link class="navbar-brand" href="/dashboard">
      <img :src="'/images/salary-secondary-32px.png'" width="30" height="30" class="d-inline-block align-top" alt="">
      Contabilidade
    </Link>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a
            class="nav-link active dropdown-toggle"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Arquivos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><Link class="dropdown-item" href="/archive/index">Todos</Link></li>
            <li><Link class="dropdown-item" href="/archive/create">Adicionar</Link></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/report">Relatórios</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link active dropdown-toggle"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Locatários
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><Link class="dropdown-item" href="/renter/index">Todos</Link></li>
            <li><Link class="dropdown-item" href="/renter/create">Adicionar</Link></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link active dropdown-toggle"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Opções
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</template>


<style scoped>
.custom-navbar {
  background-color: #F5F7F8;
}
</style>