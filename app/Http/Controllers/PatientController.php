<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Municipality;
use App\Models\Parish;
use App\Models\Patient;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with(['state', 'city', 'municipality', 'parish'])->get();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all();
        return view('patients.create', compact('states'));
    }

    public function getCitiesByState(State $state)
    {
        return response()->json($state->cities);
    }

    public function getMunicipalitiesByState(State $state)
    {
        return response()->json($state->municipalities);
    }

    public function getParishesByMunicipality(Municipality $municipality)
    {
        return response()->json($municipality->parishes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Patient::rules());

        try {
            DB::beginTransaction();

            Patient::create($request->all());

            DB::commit();

            return redirect()->route('patients.index')
                ->with('success', 'Paciente creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al registrar al paciente: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al registrar el paciente'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::with([
            'state',
            'city',
            'municipality',
            'parish',
            'state.cities',
            'state.municipalities',
            'municipality.parishes'
        ])->findOrFail($id);

        $states = State::all(); // Asegurar que se cargan todos los estados

        return view('patients.show', compact('patient', 'states'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        $states = State::all();

        return view('patients.edit', compact('patient', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate($patient->rules($id));

        try {
            DB::beginTransaction();

            $patient->update($request->all());

            DB::commit();

            return redirect()->route('patients.index')
                ->with('success', 'Paciente actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar al paciente: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al actualizar el paciente'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function estroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Paciente eliminado exitosamente.');
    }
}
