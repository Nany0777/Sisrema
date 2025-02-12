<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    use HasFactory;

    protected $fillable = ['id_municipality', 'parish'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'id_municipality');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'id_parish');
    }
}
