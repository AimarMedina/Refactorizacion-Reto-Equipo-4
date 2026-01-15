import type { Alumno } from "@/interfaces/Alumno";
import { defineStore } from 'pinia'
import axios from 'axios'

export const useAlumnosStore = defineStore('alumnos', {
  state: () => ({
    Alumno: null as Alumno | null,
    loading: false,
    error: null as string | null
  }),

  actions: {
    async fetchAlumno() {
      console.log('fetchMiAlumno START')
      this.loading = true
      this.error = null

      try {
        const res = await axios.get('http://localhost:8000/api/me/alumno')
        console.log('STATUS', res.status)
        console.log('DATA', res.data)
        this.Alumno = res.data
      } catch (e: any) {
        console.log('ERROR', e?.response?.status, e?.response?.data)
        this.Alumno = null
        this.error = e?.response?.data?.message ?? 'Error al cargar alumno'
      } finally {
        this.loading = false
      }
    }
  }
})