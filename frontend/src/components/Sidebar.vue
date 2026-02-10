<script setup>
import { computed } from "vue";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();

const userRole = computed(() => authStore.currentUser?.role);
const userId = computed(() => authStore.currentUser.id);

</script>

<template>
  <aside class="sidebar island">
    <!-- Menú para Alumnos -->
    <nav v-if="userRole === 'alumno'" class="sidebar-nav">
      <div class="sidebar-section">
        <h3>
          <RouterLink to="/alumno/inicio" class="sidebar-title">Inicio</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/alumno/mis-datos" class="sidebar-title">Mis Datos</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/alumno/empresa" class="sidebar-title">Empresa</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/alumno/seguimiento" class="sidebar-title">Entrega</RouterLink>
        </h3>
        <h3>
          <RouterLink :to="`/alumno/${userId}/calificacion`" class="sidebar-title">Calificación</RouterLink>
        </h3>
      </div>
    </nav>

    <!-- Menú para Tutores -->
    <nav v-else-if="userRole === 'tutor_egibide'" class="sidebar-nav">
      <div class="sidebar-section">
        <h3>
          <RouterLink to="/tutor_egibide/inicio" class="sidebar-title">Inicio</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/tutor_egibide/alumnos" class="sidebar-title">Mis Alumnos</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/tutor_egibide/empresas" class="sidebar-title">Empresas</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/tutor_egibide/crear-estancia" class="sidebar-title">Estancia</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/tutor_egibide/grados" class="sidebar-title">Mis Grados</RouterLink>
        </h3>
      </div>
    </nav>

    <!-- Menú para Empresas -->
    <nav v-else-if="userRole === 'tutor_empresa'" class="sidebar-nav">
      <div class="sidebar-section">
        <h3>
          <RouterLink to="/tutor_empresa/inicio" class="sidebar-title">Inicio</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/tutor_empresa/alumnos-asignados" class="sidebar-title">Alumnos Asignados</RouterLink>
        </h3>
      </div>
    </nav>

    <!-- Menú para Admin -->
    <nav v-else-if="userRole === 'admin'" class="sidebar-nav">
      <div class="sidebar-section">
        <h3>
          <RouterLink to="/admin/inicio" class="sidebar-title">Inicio</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/ciclos" class="sidebar-title">Ciclos</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/competencias" class="sidebar-title">Competencias</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/alumnos" class="sidebar-title">Alumnos</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/empresas" class="sidebar-title">Empresas</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/matriz-competencias" class="sidebar-title">Competencias vs Ras</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/nuevo-ciclo" class="sidebar-title">Ciclo</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/nueva-competencia" class="sidebar-title">Competencia</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/nueva-empresa" class="sidebar-title">Empresa</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/nuevo-alumno" class="sidebar-title">Alumno</RouterLink>
        </h3>
        <h3>
          <RouterLink to="/admin/importar" class="sidebar-title">Importar Datos</RouterLink>
        </h3>
      </div>
    </nav>

    <!-- Menú por defecto -->
    <nav v-else class="sidebar-nav">
      <div class="sidebar-section">
        <p class="text-muted text-center py-4 mb-0">
          No se ha identificado el tipo de usuario
        </p>
      </div>
    </nav>
  </aside>
</template>

<style scoped></style>
