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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('celular');
            $table->string('email'); 
            $table->string('password');    
            $table->bigInteger('idPerfil')->unsigned();
            $table->integer('puntos');    
            
                    
            $table->timestamps();


            $table->foreign('idPerfil')->references('id')->on('perfil')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
};
