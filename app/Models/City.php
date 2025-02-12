<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['id_state', 'city', 'capital'];

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'id_city');
    }
}
