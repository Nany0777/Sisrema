<?php

// app/Models/Doctor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'telefono', 'especialidad'];
    
    public static function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|integer',
            'especialidad' => 'required|string|max:100'
        ];
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'id_doctor');
    }

}