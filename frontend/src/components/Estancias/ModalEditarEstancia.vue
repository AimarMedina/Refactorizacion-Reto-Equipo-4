<script setup lang="ts">
import { ref, onMounted } from "vue";
import type { Estancia } from "@/interfaces/Estancia";
import type { Empresa } from "@/interfaces/Empresa";

const props = defineProps<{
  estancia: Estancia;
  alumnoId: number;
}>();

const emit = defineEmits<{
  close: [];
  estanciaActualizada: [];
}>();

const baseURL = import.meta.env.VITE_API_BASE_URL;
const token = localStorage.getItem("token");

const form = ref({
  puesto: props.estancia.puesto || "",
  fecha_inicio: props.estancia.fecha_inicio || "",
  fecha_fin: props.estancia.fecha_fin || "",
  horas_totales: props.estancia.horas_totales || 0,
  empresa_id: props.estancia.empresa_id || null,
});

const empresas = ref<Empresa[]>([]);
const isLoading = ref(false);
const error = ref<string | null>(null);

const cargarEmpresas = async () => {
  try {
    const response = await fetch(`${baseURL}/api/empresas`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json",
      },
    });

    if (!response.ok) throw new Error("Error al cargar empresas");

    empresas.value = await response.json();
  } catch (e) {
    console.error(e);
    error.value = "Error al cargar las empresas";
  }
};

const guardarCambios = async () => {
  isLoading.value = true;
  error.value = null;

  try {
    const response = await fetch(
      `${baseURL}/api/estancias/${props.estancia.id}`,
      {
        method: "PUT",
        headers: {
          Authorization: `Bearer ${token}`,
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({
          ...form.value,
          alumno_id: props.alumnoId,
        }),
      }
    );

    if (!response.ok) {
      const data = await response.json();
      throw new Error(data.message || "Error al actualizar la estancia");
    }

    emit("estanciaActualizada");
  } catch (e: any) {
    console.error(e);
    error.value = e.message || "Error al guardar los cambios";
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  cargarEmpresas();
});
</script>

<template>
  <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="bi bi-pencil-fill me-2"></i>
            Editar Estancia
          </h5>
          <button
            type="button"
            class="btn-close"
            @click="emit('close')"
          ></button>
        </div>

        <div class="modal-body">
          <div v-if="error" class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ error }}
          </div>

          <form @submit.prevent="guardarCambios">
            <div class="mb-3">
              <label for="empresa" class="form-label">Empresa</label>
              <select
                id="empresa"
                v-model="form.empresa_id"
                class="form-select"
              >
                <option :value="null">Seleccionar empresa...</option>
                <option
                  v-for="empresa in empresas"
                  :key="empresa.id"
                  :value="empresa.id"
                >
                  {{ empresa.nombre }}
                </option>
              </select>
            </div>

            <div class="mb-3">
              <label for="puesto" class="form-label">Puesto</label>
              <input
                id="puesto"
                v-model="form.puesto"
                type="text"
                class="form-control"
                placeholder="Ej: Desarrollador Web"
              />
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input
                  id="fecha_inicio"
                  v-model="form.fecha_inicio"
                  type="date"
                  class="form-control"
                />
              </div>

              <div class="col-md-6 mb-3">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input
                  id="fecha_fin"
                  v-model="form.fecha_fin"
                  type="date"
                  class="form-control"
                />
              </div>
            </div>

            <div class="mb-3">
              <label for="horas_totales" class="form-label">Horas Totales</label>
              <input
                id="horas_totales"
                v-model.number="form.horas_totales"
                type="number"
                class="form-control"
                min="0"
                placeholder="Ej: 400"
              />
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="emit('close')"
            :disabled="isLoading"
          >
            Cancelar
          </button>
          <button
            type="button"
            class="btn btn-primary"
            @click="guardarCambios"
            :disabled="isLoading"
          >
            <span v-if="isLoading">
              <span class="spinner-border spinner-border-sm me-2"></span>
              Guardando...
            </span>
            <span v-else>
              <i class="bi bi-check-circle-fill me-2"></i>
              Guardar Cambios
            </span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
