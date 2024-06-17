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
        Schema::create('partidos', function (Blueprint $table) {


            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('idEquipoLocal')->unsigned();  
            $table->bigInteger('idEquipoVisitante')->unsigned(); 
            $table->bigInteger('jornada')->unsigned(); 
            $table->boolean('estado');
            $table->timestamps();
 
            
            $table->foreign('idEquipoLocal')->references('id')->on('equipos')->onDelete("cascade");
            $table->foreign('idEquipoVisitante')->references('id')->on('equipos')->onDelete("cascade");
            $table->foreign('jornada')->references('id')->on('jornadas')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidos');
    }
};
