<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('plan',10);
            $table->string('area',5)->nullable();
            $table->string('programa',100);
            $table->string('abrev',10)->nullable();
            $table->string('plant',4);
            $table->tinyInteger('periodos')->nullable();
            $table->timestamps();
            $table->foreign('plant')
                  ->references('plant')->on('des')
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
        Schema::drop('programa');
    }
}
