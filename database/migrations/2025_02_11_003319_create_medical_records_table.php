<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_doctor');
            $table->integer("numero_historia");
            $table->date('fecha_nacimiento');
            $table->enum('tipo_samgre', [ 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->date("fecha_ultimo_examen_fisico")->nullable();
            $table->text("alergias")->nullable();
            $table->text("enfermedades")->nullable();
            $table->text("descripcion")->nullable();
            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_doctor')->references('id')->on('doctors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
