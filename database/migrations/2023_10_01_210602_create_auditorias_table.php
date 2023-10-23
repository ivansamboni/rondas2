<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta',1000);
            $table->string('estrategia',255);  
            $table->string('cargo',255);               
            $table->string('servicio',255); 
            $table->string('respuesta',255)->nullable(); 
            $table->string('observacion',1000)->nullable();
            $table->string('auditoria',255);     
            $table->string('estrategia_id',255);               
            $table->date('fecha'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditorias');
    }
};
