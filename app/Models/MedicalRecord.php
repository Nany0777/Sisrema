<?php

// app/Models/MedicalRecord.php
// app/Models/MedicalRecord.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_patient', 'id_doctor', 'numero_historia', 'fecha_nacimiento',
        'tipo_samgre', 'fecha_ultimo_examen_fisico', 'alergias', 'enfermedades', 'descripcion'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ultimo_examen_fisico' => 'date'
    ];
    
    public static function rules($id = null)
    {
        return [
            'id_patient' => 'required|exists:patients,id',
            'id_doctor' => 'required|exists:doctors,id',
            'numero_historia' => [
                'required',
                'integer',
                Rule::unique('medical_records')->ignore($id)
            ],
            'fecha_nacimiento' => 'required|date',
            'tipo_samgre' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'fecha_ultimo_examen_fisico' => 'nullable|date',
            'alergias' => 'nullable|string',
            'enfermedades' => 'nullable|string',
            'descripcion' => 'nullable|string'
        ];
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }
}