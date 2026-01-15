import type { Alumno } from "@/interfaces/Alumno"
import { defineStore } from "pinia"
import { useAuthStore } from "./auth";

export const useAlumnosStore = defineStore("alumnos", {
  state: () => ({
    Alumno: null as Alumno | null,
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchAlumno() {
      const authStore = useAuthStore()

      this.loading = true
      this.error = null

      try {
        const response = await fetch("http://localhost:8000/api/me/alumno", {
          method: "GET",
          headers: {
            Authorization: authStore.token ? `Bearer ${authStore.token}` : "",
            Accept: "application/json",
          },
        })

        if (!response.ok) {
          const err = await response.json().catch(() => ({}))
          throw { status: response.status, data: err }
        }

        const data: Alumno = await response.json()
        this.Alumno = data
      } catch (e: any) {
        this.Alumno = null
        this.error = e?.data?.message ?? "Error al cargar alumno"
      } finally {
        this.loading = false
      }
    },
  },
})