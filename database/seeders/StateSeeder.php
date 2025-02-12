<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['id' => 1, 'state' => 'Amazonas'],
            ['id' => 2, 'state' => 'Anzoátegui'],
            ['id' => 3, 'state' => 'Apure'],
            ['id' => 4, 'state' => 'Aragua'],
            ['id' => 5, 'state' => 'Barinas'],
            ['id' => 6, 'state' => 'Bolívar'],
            ['id' => 7, 'state' => 'Carabobo'],
            ['id' => 8, 'state' => 'Cojedes'],
            ['id' => 9, 'state' => 'Delta Amacuro'],
            ['id' => 10, 'state' => 'Falcón'],
            ['id' => 11, 'state' => 'Guárico'],
            ['id' => 12, 'state' => 'Lara'],
            ['id' => 13, 'state' => 'Mérida'],
            ['id' => 14, 'state' => 'Miranda'],
            ['id' => 15, 'state' => 'Monagas'],
            ['id' => 16, 'state' => 'Nueva Esparta'],
            ['id' => 17, 'state' => 'Portuguesa'],
            ['id' => 18, 'state' => 'Sucre'],
            ['id' => 19, 'state' => 'Táchira'],
            ['id' => 20, 'state' => 'Trujillo'],
            ['id' => 21, 'state' => 'Vargas'],
            ['id' => 22, 'state' => 'Yaracuy'],
            ['id' => 23, 'state' => 'Zulia'],
            ['id' => 24, 'state' => 'Distrito Capital'],
            ['id' => 25, 'state' => 'Dependencias Federales'],
        ]);
    }
}
