<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['state'];

    public function cities()
    {
        return $this->hasMany(City::class, 'id_state');
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'id_state');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'id_state');
    }
}
