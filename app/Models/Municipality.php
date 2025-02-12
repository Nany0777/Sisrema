<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = ['id_state', 'municipality'];

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function parishes()
    {
        return $this->hasMany(Parish::class, 'id_municipality');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'id_municipality');
    }
}
