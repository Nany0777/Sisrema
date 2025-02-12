<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\State;
use App\Models\City;
use App\Models\Municipality;
use App\Models\Parish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HistoryRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['patient', 'doctor'])->get();
        return view('history-records.index', compact('records'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $states = State::all();
        $cities = City::all();
        $municipalities = Municipality::all();
        $parishes = Parish::all();

        return view('history-records.create', compact('doctors', 'patients', 'states', 'cities', 'municipalities', 'parishes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), MedicalRecord::rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        try {
            DB::beginTransaction();

            // Si se está creando un nuevo paciente
            /* if ($request->has('new_patient')) {
                $patientValidator = Validator::make($request->all(), Patient::rules());
                
                

                // Crear el paciente
                $patient = Patient::create($request->all());
                $request->merge(['id_patient' => $patient->id]);
                } */

            // Validar la historia médica

            // Crear la historia médica
            MedicalRecord::create($request->all());

            DB::commit();

            return redirect()->route('history-records.index')
                ->with('success', 'Historia médica creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al crear la historia médica: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al crear la historia médica'])
                ->withInput();
        }
    }

    public function show(string $id)
    {
        $record = MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);
        $doctors = Doctor::all();
        return view('history-records.show', compact('record', 'doctors'));
    }

    public function update(Request $request, string $id)
    {
        $record = MedicalRecord::findOrFail($id);

        $validator = Validator::make($request->all(), MedicalRecord::rules($id));

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();


            $record->update($request->all());

            DB::commit();

            return redirect()->route('history-records.show', $id)
                ->with('success', 'Historia médica actualizada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al actualizar la historia médica: " . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Ocurrió un error al actualizar la historia médica'])
                ->withInput();
        }
    }
}
