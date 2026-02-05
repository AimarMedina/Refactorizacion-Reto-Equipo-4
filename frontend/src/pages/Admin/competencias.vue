<script setup lang="ts">
import { computed, ref, onMounted } from "vue";
import { useCompetenciasStore } from "@/stores/competencias";
import type { Competencia } from "@/interfaces/Competencia";

const competenciasStore = useCompetenciasStore();

const isLoading = ref(true);
const searchQuery = ref("");
const showTecnicas = ref(true);
const showTransversales = ref(true);

// Fetch competencias al montar
onMounted(async () => {
  isLoading.value = true;
  try {
    await competenciasStore.fetchCompetencias();
  } catch (err) {
    console.error("Error al cargar competencias:", err);
  } finally {
    isLoading.value = false;
  }
});

// Filtrado por búsqueda
const competenciasFiltradas = computed<Competencia[]>(() => {
  const all = competenciasStore.competencias;
  if (!searchQuery.value.trim()) return all;

  const query = searchQuery.value.toLowerCase();
  return all.filter(
    c =>
      c.descripcion.toLowerCase().includes(query) ||
      (c.tipo && c.tipo.toLowerCase().includes(query))
  );
});

// Separar por tipo
const competenciasTecnicas = computed(() =>
  competenciasFiltradas.value.filter(c => c.tipo === "TECNICA")
);

const competenciasTransversales = computed(() =>
  competenciasFiltradas.value.filter(c => c.tipo === "TRANSVERSAL")
);

const toggleTecnicas = () => {
  showTecnicas.value = !showTecnicas.value;
};

const toggleTransversales = () => {
  showTransversales.value = !showTransversales.value;
};
</script>

<template>
  <div class="alumnos-asignados-container">
    <h2>Listado de Competencias</h2>
    <hr />

    <!-- Buscador -->
    <div class="mb-3">
      <div class="input-group">
        <span class="input-group-text bg-white border-end-0">
          <i class="bi bi-search"></i>
        </span>
        <input
          v-model="searchQuery"
          type="text"
          class="form-control border-start-0"
          placeholder="Buscar competencias..."
          :disabled="isLoading || competenciasStore.competencias.length === 0"
        />
      </div>
    </div>

    <!-- Loading -->
    <div v-if="isLoading" class="text-center py-5">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
      </div>
      <p class="mt-3 text-muted fw-semibold">Cargando competencias disponibles...</p>
    </div>

    <!-- Sin competencias -->
    <div
      v-else-if="competenciasStore.competencias.length === 0"
      class="alert alert-info d-flex align-items-center"
    >
      <i class="bi bi-info-circle-fill me-2"></i>
      <div>No hay competencias registradas en el sistema.</div>
    </div>

    <!-- Sin resultados -->
    <div
      v-else-if="competenciasFiltradas.length === 0"
      class="alert alert-warning d-flex align-items-center"
    >
      <i class="bi bi-search me-2"></i>
      <div>No se encontraron competencias que coincidan con "{{ searchQuery }}"</div>
    </div>

    <!-- Listado con desplegables -->
    <div v-else>
      <!-- Técnicas -->
      <div v-if="competenciasTecnicas.length > 0" class="mb-4">
        <div
          class="section-header d-flex align-items-center py-2 cursor-pointer"
          @click="toggleTecnicas"
        >
          <div class="avatar-circle bg-tecnica me-3">
            <i class="bi bi-tools"></i>
          </div>
          <h3 class="mb-0 flex-grow-1">Competencias Técnicas</h3>
          <span class="badge bg-tecnica rounded-pill me-3">
            {{ competenciasTecnicas.length }}
          </span>
          <i
            class="bi fs-4 transition-icon"
            :class="showTecnicas ? 'bi-chevron-up' : 'bi-chevron-down'"
          ></i>
        </div>

        <div class="collapse" :class="{ show: showTecnicas }">
          <div class="list-group list-group-flush mt-2">
            <div
              v-for="c in competenciasTecnicas"
              :key="c.id"
              class="list-group-item d-flex align-items-center py-3 mb-2"
            >
              <div class="avatar-circle-small bg-tecnica me-3">
                <i class="bi bi-gear-fill"></i>
              </div>
              <div>
                <span>{{ c.descripcion }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Transversales -->
      <div v-if="competenciasTransversales.length > 0">
        <div
          class="section-header d-flex align-items-center py-2 cursor-pointer"
          @click="toggleTransversales"
        >
          <div class="avatar-circle bg-transversal me-3">
            <i class="bi bi-people-fill"></i>
          </div>
          <h3 class="mb-0 flex-grow-1">Competencias Transversales</h3>
          <span class="badge bg-transversal rounded-pill me-3">
            {{ competenciasTransversales.length }}
          </span>
          <i
            class="bi fs-4 transition-icon"
            :class="showTransversales ? 'bi-chevron-up' : 'bi-chevron-down'"
          ></i>
        </div>

        <div class="collapse" :class="{ show: showTransversales }">
          <div class="list-group list-group-flush mt-2">
            <div
              v-for="c in competenciasTransversales"
              :key="c.id"
              class="list-group-item d-flex align-items-center py-3 mb-2"
            >
              <div class="avatar-circle-small bg-transversal me-3">
                <i class="bi bi-star-fill"></i>
              </div>
              <div>
                <span>{{ c.descripcion }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Contador -->
      <div class="mt-3">
        <small class="text-muted">
          Mostrando {{ competenciasFiltradas.length }} de {{ competenciasStore.competencias.length }} competencia(s)
        </small>
      </div>
    </div>
  </div>
</template>

<style scoped>
.list-group-item {
  border-radius: 0.5rem;
}

.alumnos-asignados-container {
  padding: 0.5rem 0;
}

.avatar-circle {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.4rem;
  flex-shrink: 0;
}

.avatar-circle-small {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1rem;
  flex-shrink: 0;
}

/* Colores según tipo */
.bg-tecnica {
  background: linear-gradient(
    135deg,
    #81045f 0%,
    #07dbb1 100%
  );
}

.bg-transversal {
  background: linear-gradient(
    135deg,
    #81045f 0%,
    #f39c12 100%
  );
}

h2 {
  margin-bottom: 1rem;
}

h3 {
  margin-bottom: 0.5rem;
}

.section-header {
  cursor: pointer;
  user-select: none;
  border-radius: 0.5rem;
  padding: 0.5rem;
  transition: background-color 0.2s;
}

.section-header:hover {
  background-color: #f8f9fa;
}

.cursor-pointer {
  cursor: pointer;
}

.transition-icon {
  transition: transform 0.3s ease;
  color: #6c757d;
}
</style>
