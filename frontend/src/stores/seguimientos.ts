import { defineStore } from "pinia";
import { ref } from "vue";
import { useAuthStore } from "./auth";
import type { Seguimiento } from "@/interfaces/Seguimiento";

export const useSeguimientosStore = defineStore("seguimientos", () => {
  const seguimientos = ref<Seguimiento[]>([]);
  const loading = ref(false);
  const error = ref<string | null>(null);
  const authStore = useAuthStore();

  // Traer seguimientos de un alumno
  async function fetchSeguimientos(alumnoId: number) {
    loading.value = true;
    error.value = null;
    try {
      const res = await fetch(`http://localhost:8000/api/seguimientos/alumno/${alumnoId}`, {
        headers: authStore.token
          ? { Authorization: `Bearer ${authStore.token}`, Accept: "application/json" }
          : { Accept: "application/json" },
      });
      if (!res.ok) throw new Error(`Error ${res.status}`);
      const data = await res.json();
      seguimientos.value = data as Seguimiento[];
    } catch (err: any) {
      error.value = err.message;
      seguimientos.value = [];
    } finally {
      loading.value = false;
    }
  }

  // Crear un nuevo seguimiento
  async function nuevoSeguimiento(payload: {
  alumno_id: number;
  fecha: string | null;
  accion: string;
  descripcion?: string;
  via?: string;
}) {
  if (!payload.fecha) throw new Error("La fecha es obligatoria");

  loading.value = true;
  error.value = null;

  try {
    const res = await fetch("http://localhost:8000/api/nuevo-seguimiento", {
      method: "POST",
      headers: authStore.token
        ? { "Content-Type": "application/json", Authorization: `Bearer ${authStore.token}` }
        : { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    });

    if (!res.ok) {
      const errData = await res.json().catch(() => null);
      throw new Error(errData?.message || `Error ${res.status}`);
    }

    const data = await res.json();
    // Añadir el seguimiento creado al array local
    seguimientos.value.unshift(data.seguimiento);
    return data.seguimiento;
  } catch (err: any) {
    error.value = err.message;
    throw err;
  } finally {
    loading.value = false;
  }
}


  return { seguimientos, loading, error, fetchSeguimientos, nuevoSeguimiento };
});
