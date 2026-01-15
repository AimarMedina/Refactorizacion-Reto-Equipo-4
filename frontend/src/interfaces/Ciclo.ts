import type { FamiliaProfesional } from "./FamiliaProfesional";

export interface Ciclo {
  id: number;
  nombre: string;
  id_familia: FamiliaProfesional["id_familia"];
}
