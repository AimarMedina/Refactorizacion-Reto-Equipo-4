import type { Alumno } from "./Alumno";

export interface Curso {
  id: number;
  numero: number;
  alumnos: Alumno[]
}
