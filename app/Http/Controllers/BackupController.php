<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\Commands\BackupCommand;

class BackupController extends Controller
{
    public function create()
    {
        try {
            // Ejecutar el comando de backup
            \Artisan::call('backup:run');

            return back()->with('success', 'Backup creado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear el backup: ' . $e->getMessage());
        }
    }
}