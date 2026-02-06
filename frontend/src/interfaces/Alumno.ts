import type { Estancia } from "./Estancia";

export interface Alumno {
  id: number;
  nombre: string;
  apellidos: string;
  email?: string;
  telefono?: string;
  fecha: string;
  ciudad?: string;
  user_id: number;
  created_at: string;
  updated_at: string;
  estancias?: Estancia[]; // <-- aquí van las estancias reales
}
