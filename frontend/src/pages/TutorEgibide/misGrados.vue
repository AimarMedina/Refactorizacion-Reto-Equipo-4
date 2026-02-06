<template>
  <div class="container my-5">
    <h1 class="text-center mb-4">Cursos con alumnos sin tutor</h1>

    <!-- Cargando -->
    <div v-if="storeTutor.loading" class="text-center text-primary">
      <div class="spinner-border" role="status"></div>
      <p class="mt-2">Cargando cursos...</p>
    </div>

    <!-- No hay cursos -->
    <div v-else-if="storeTutor.misCursos.length === 0" class="text-center text-muted fst-italic">
      No hay alumnos sin tutor asignado.
    </div>

    <!-- Cursos -->
    <div v-else class="accordion" id="cursosAccordion">
      <div v-for="(curso, index) in storeTutor.misCursos" :key="curso.id" class="accordion-item">
        <h2 class="accordion-header" :id="'heading' + curso.id">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  :data-bs-target="'#collapse' + curso.id" aria-expanded="false"
                  :aria-controls="'collapse' + curso.id">
            <i class="bi bi-journal-text me-2"></i>
            {{ curso.ciclo.nombre }}
            <span class="badge bg-secondary ms-2">Alumnos: {{ curso.alumnos.length }}</span>
          </button>
        </h2>

        <div :id="'collapse' + curso.id" class="accordion-collapse collapse"
             :aria-labelledby="'heading' + curso.id" data-bs-parent="#cursosAccordion">
          <div class="accordion-body p-0">
            <ul v-if="curso.alumnos.length > 0" class="list-group list-group-flush">
              <li v-for="alumno in curso.alumnos" :key="alumno.id"
                  class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <i class="bi bi-person-fill text-primary me-2"></i>
                  {{ alumno.nombre }} {{ alumno.apellidos }}
                </div>
                <button class="btn btn-sm btn-indigo" @click="asignarmeAlumno(alumno)">
                  <i class="bi bi-person-plus-fill me-1"></i> Asignarme
                </button>
              </li>
            </ul>
            <div v-else class="p-3 text-muted fst-italic">
              <i class="bi bi-check-circle me-1"></i> Todos los alumnos tienen tutor asignado.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast de notificación -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div ref="toast" class="toast align-items-center text-white bg-success border-0" role="alert"
           aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            Alumno asignado correctamente.
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                  aria-label="Close"></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useTutorEgibideStore } from '@/stores/tutorEgibide';
import { onMounted, ref } from 'vue';

const storeTutor = useTutorEgibideStore();
const toast = ref(null);

onMounted(async () => {
  await storeTutor.fetchInicioTutor();
  await storeTutor.fetchAlumnosDeMiCursoSinTutorAsignado(storeTutor.inicio.tutor.id);
});

const asignarmeAlumno = async (alumno) => {
  try {
    await storeTutor.asignarAlumnoATutor(alumno.id, storeTutor.inicio.tutor.id);
    // refrescar lista
    await storeTutor.fetchAlumnosDeMiCursoSinTutorAsignado(storeTutor.inicio.tutor.id);

    // mostrar toast
    const bsToast = new bootstrap.Toast(toast.value);
    bsToast.show();
  } catch (error) {
    console.error(error);
    alert('Error al asignar el alumno.');
  }
};
</script>
