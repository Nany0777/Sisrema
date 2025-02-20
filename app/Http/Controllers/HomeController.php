<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Doctor;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Patient::count();
        $doctores = Doctor::count();
        $historias = MedicalRecord::count();
    
        return view('home', compact('pacientes', 'doctores', 'historias'));
    }

    public function data(Request $request)
    {
        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');

            $registros = MedicalRecord::with(['patient', 'doctor'])
                ->when($fecha_inicio && $fecha_fin, function ($query) use ($fecha_inicio, $fecha_fin) {
                    return $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
                })
                ->orderBy('fecha', 'desc')
                ->get();

            return response()->json(['data' => $registros]);
        }

        $registros = MedicalRecord::all();

        return response()->json(['data' => $registros]); 

        
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
