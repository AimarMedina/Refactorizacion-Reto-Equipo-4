<?php

namespace App\Http\Controllers;

use App\Models\Estancia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estancias = Estancia::with(['alumno', 'empresa', 'tutor', 'instructor', 'curso'])->get();
        return response()->json($estancias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'puesto' => 'nullable|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'horas_totales' => 'nullable|integer|min:0',
            'alumno_id' => 'required|exists:alumnos,id',
            'tutor_id' => 'nullable|exists:tutor_egibides,id',
            'instructor_id' => 'nullable|exists:tutor_empresas,id',
            'empresa_id' => 'nullable|exists:empresas,id',
            'curso_id' => 'nullable|exists:cursos,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $estancia = Estancia::create($request->all());
        $estancia->load(['alumno', 'empresa', 'tutor', 'instructor', 'curso']);

        return response()->json([
            'message' => 'Estancia creada exitosamente',
            'estancia' => $estancia
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estancia = Estancia::with(['alumno', 'empresa', 'tutor', 'instructor', 'curso'])->find($id);

        if (!$estancia) {
            return response()->json(['message' => 'Estancia no encontrada'], 404);
        }

        return response()->json($estancia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estancia = Estancia::find($id);

        if (!$estancia) {
            return response()->json(['message' => 'Estancia no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'puesto' => 'nullable|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'horas_totales' => 'nullable|integer|min:0',
            'alumno_id' => 'sometimes|required|exists:alumnos,id',
            'tutor_id' => 'nullable|exists:tutor_egibides,id',
            'instructor_id' => 'nullable|exists:tutor_empresas,id',
            'empresa_id' => 'nullable|exists:empresas,id',
            'curso_id' => 'nullable|exists:cursos,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $estancia->update($request->all());
        $estancia->load(['alumno', 'empresa', 'tutor', 'instructor', 'curso']);

        return response()->json([
            'message' => 'Estancia actualizada exitosamente',
            'estancia' => $estancia
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estancia = Estancia::find($id);

        if (!$estancia) {
            return response()->json(['message' => 'Estancia no encontrada'], 404);
        }

        $estancia->delete();

        return response()->json([
            'message' => 'Estancia eliminada exitosamente'
        ]);
    }

    /**
     * Get estancias by alumno
     */
    public function getEstanciasByAlumno($alumnoId)
    {
        $estancias = Estancia::where('alumno_id', $alumnoId)
            ->with(['empresa', 'tutor', 'instructor', 'curso'])
            ->get();

        return response()->json($estancias);
    }
}
