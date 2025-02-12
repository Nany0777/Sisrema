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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellido");
            $table->bigInteger('ci')->unique();
            $table->integer("edad");
            $table->enum("sexo", ['Masculino', 'Femenino']);
            $table->decimal("peso", 8, 2);
            $table->enum("nacionalidad", ['Venezolano', 'Extranjero']);
            $table->string("ocupacion")->nullable();
            $table->string("representante");
            $table->bigInteger("telefono");
            $table->boolean("embarazo")->default(0);
            $table->boolean("madre_lactante")->default(0);
            $table->text("direccion");
            $table->unsignedBigInteger("id_state");
            $table->unsignedBigInteger("id_city");
            $table->unsignedBigInteger("id_municipality");
            $table->unsignedBigInteger("id_parish");
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_state')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('id_city')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('id_municipality')->references('id')->on('municipalities')->onDelete('cascade');
            $table->foreign('id_parish')->references('id')->on('parishes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
