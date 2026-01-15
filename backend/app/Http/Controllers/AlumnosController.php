<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Alumnos::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumnos $alumnos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumnos $alumnos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumnos $alumnos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumnos $alumnos)
    {
        //
    }

    public function me()
{
    $userId = auth()->id();

    $row = Alumnos::join('users', 'alumnos.user_id', '=', 'users.id')
        ->select(
            'alumnos.nombre',
            'alumnos.apellidos',
            'alumnos.telefono',
            'alumnos.ciudad',

            'users.email',
        )
        ->where('alumnos.user_id', $userId)
        ->first();

    if (!$row) {
        return response()->json(['message' => 'Alumno no encontrado'], 404);
    }

    return response()->json($row);
}
}
