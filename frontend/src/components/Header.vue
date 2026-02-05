<script setup lang="ts">
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();

function logout() {
  authStore.logout();
}

let user = authStore.fetchCurrentUser()
console.log(user)

</script>

<template>
  <nav class="navbar navbar-expand-lg island">
    <div class="container-fluid">
      <img src="../assets/images/logotipo.png" alt="logotipo" height="50" />
      <div class="dropdown">
        <button class="btn p-0 border-0 bg-transparent" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-three-dots-vertical fs-5"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
          <li>
            <button class="dropdown-item d-flex align-items-center gap-2 text-danger" @click="logout">
              <i class="bi bi-box-arrow-right"></i>
              Cerrar sesión
            </button>
          </li>
        </ul>
      </div>


    </div>
  </nav>
</template>

<style scoped></style>
