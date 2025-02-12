<?php

// app/Models/Patient.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'ci', 'edad', 'sexo', 'peso', 'nacionalidad',
        'ocupacion', 'representante', 'telefono', 'embarazo', 'madre_lactante',
        'direccion', 'id_state', 'id_city', 'id_municipality', 'id_parish'
    ];

    protected $casts = [
        'embarazo' => 'boolean',
        'madre_lactante' => 'boolean',
        'ci' => 'string'
    ];
    
    public static function rules($id = null)
    {
        return [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'ci' => [
                'required',
                'numeric',
                Rule::unique('patients')->ignore($id)
            ],
            'edad' => 'required|integer|min:0|max:150',
            'sexo' => 'required|in:Masculino,Femenino',
            'peso' => 'required|numeric|min:0|max:500',
            'nacionalidad' => 'required|in:Venezolano,Extranjero',
            'ocupacion' => 'nullable|string|max:100',
            'representante' => 'required|string|max:200',
            'telefono' => 'required|numeric',
            'embarazo' => 'sometimes|boolean',
            'madre_lactante' => 'sometimes|boolean',
            'direccion' => 'required|string|max:255',
            'id_state' => 'required|exists:states,id',
            'id_city' => 'required|exists:cities,id',
            'id_municipality' => 'required|exists:municipalities,id',
            'id_parish' => 'required|exists:parishes,id'
        ];
    }

    // Relaciones
    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'id_municipality');
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class, 'id_parish');
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class, 'id_patient');
    }
}