import type { FamiliaProfesional } from "./FamiliaProfesional";
import type { Asignatura } from "./Asignatura";

export interface Ciclo {
  id: number;
  nombre: string;
  familia_profesional_id: FamiliaProfesional["id"];
  asignaturas?:Asignatura[];
}
