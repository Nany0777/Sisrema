<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Doctor::rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $doctor = Doctor::create($request->all());

            DB::commit();

            return redirect()->route('doctors.index')
                ->with('success', 'Paciente creado exitosamente.');

        } catch (\exception $e) {
            DB::rollBack();
            \Log::error("Error al registrar al doctor: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrio un error al registrar el doctor'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', compact('doctor'));
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
        $doctor = Doctor::findOrFail($id);

        $validator = Validator::make($request->all(), Doctor::rules($doctor->id)); // Pasa el ID para reglas únicas

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $doctor->update($request->all());

            DB::commit();

            return redirect()->route('doctors.index')
                ->with('success', 'Doctor actualizado exitosamente.'); // Mensaje corregido

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar al doctor: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al actualizar el doctor']) // Mensaje corregido
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
