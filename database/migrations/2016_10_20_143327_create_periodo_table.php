<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ciclo')->unsigned();
            $table->string('plant',4);
            $table->tinyInteger('tipo')->unsigned();
            $table->date('pde');
            $table->date('pa');
            $table->boolean('activo')->default(true);            
            $table->timestamps();
            $table->foreign('id_ciclo')
                    ->references('id')->on('ciclo')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('periodo');
    }
}
