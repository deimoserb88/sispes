<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_programa')->unsigned();
            $table->enum('gpo',['A','B','C','D','E','F','G','H']);
            $table->tinyInteger('sem');            
            $table->timestamps();
            $table->foreign('id_programa')
                    ->references('id')->on('programa')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grupo');
    }
}
