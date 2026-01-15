<script setup lang="ts">
import { useCiclosStore } from "@/stores/ciclos";
import { useCompetenciasStore } from "@/stores/competencias";
import { useFamiliaProfesionalesStore } from "@/stores/familiasProfesionales";
import { computed, onMounted, ref } from "vue";

const familiaProfesionalStore = useFamiliaProfesionalesStore();
const cicloStore = useCiclosStore();
const competenciaStore = useCompetenciasStore();

const tipoCompetencia = ref<string>("tecnica");
const familiaProfesional = ref<number>(0);
const ciclo = ref<number>(0);
const descripcion = ref<string>("");

const ciclosFamilia = computed(() => {
  if (!familiaProfesional.value) return [];
  return cicloStore.getCiclosPorFamilia(familiaProfesional.value);
});

onMounted(async () => {
  await familiaProfesionalStore.fetchFamiliasProfesionales();
  await cicloStore.fetchCiclos();
});

function agregarCompetencia() {
  if (tipoCompetencia.value === "tecnica") {
    competenciaStore.createCompetenciaTecnica(ciclo.value, descripcion.value);
  } else {
    competenciaStore.createCompetenciaTransversal(
      familiaProfesional.value,
      descripcion.value,
    );
  }
}
</script>

<template>
  <h2>NUEVA COMPETENCIA</h2>
  <hr />
  <form @submit.prevent="agregarCompetencia" class="row-cols-1">
    <div class="mb-3">
      <!-- Tipo de competencia -->
      <p>Tipo de competencia</p>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          name="tipoCompetencia"
          id="tecnica"
          value="tecnica"
          v-model="tipoCompetencia"
        />
        <label class="form-check-label" for="tecnica">Técnica</label>
      </div>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          name="tipoCompetencia"
          id="transversal"
          value="transversal"
          v-model="tipoCompetencia"
        />
        <label class="form-check-label" for="transversal">Transversal</label>
      </div>
    </div>

    <!-- Familia profesional -->
    <div class="mb-3 col-5">
      <label for="familiaProfesional" class="form-label"
        >Familia profesional:</label
      >
      <select
        class="form-select"
        v-model.number="familiaProfesional"
        id="familia"
        required
      >
        <option :value="0" disabled>-- Selecciona una opción --</option>
        <option
          v-for="familia in familiaProfesionalStore.familiasProfesionales"
          :key="familia.id_familia"
          :value="familia.id_familia"
        >
          {{ familia.nombre }}
        </option>
      </select>
    </div>

    <!-- Descripción de la competencia -->
    <div class="mb-3 col-5">
      <label for="descripcion" class="form-label">Descripción:</label>
      <div class="form-floating">
        <textarea
          class="form-control"
          placeholder="Leave a comment here"
          id="descripcion"
          style="height: 120px; max-height: 280px"
          v-model="descripcion"
        ></textarea>
        <label for="descripción">Descripción de la competencia</label>
      </div>
    </div>

    <!-- Si la competencia a agregar es tecnica se cargan los ciclos de de la familia profesional seleccionada -->
    <div v-if="tipoCompetencia === 'tecnica'" class="mb-3 col-5">
      <label for="ciclo" class="form-label">Ciclo:</label>
      <select class="form-select" v-model.number="ciclo" id="ciclo" required>
        <option :value="0" disabled>-- Selecciona una opción --</option>
        <option
          v-for="ciclo in ciclosFamilia"
          :key="ciclo.id"
          :value="ciclo.id"
        >
          {{ ciclo.nombre }}
        </option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary col-2">Agregar</button>
  </form>
</template>

<style scoped></style>
