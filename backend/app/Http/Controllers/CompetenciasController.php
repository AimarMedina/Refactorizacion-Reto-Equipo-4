<?php

namespace App\Http\Controllers;

use App\Models\Competencias;
use Illuminate\Http\Request;

class CompetenciasController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Competencias::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTecnica(Request $request) {
        $validated = $request->validate([
            'id_ciclo' => ['required'],
            'descripcion' => ['required']
        ]);

        Competencias::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Competencia técnica agregada'
        ], 201);
    }

    public function storeTranversal(Request $request) {
        $validated = $request->validate([
            'id_familia' => ['required'],
            'descripcion' => ['required']
        ]);

        Competencias::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Competencia Transversa agregada'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Competencias $competencias) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competencias $competencias) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competencias $competencias) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competencias $competencias) {
        //
    }
}
