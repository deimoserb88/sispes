<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaXXXXTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $plants = ['3010','3020','3030','3040','3041','4012','5010','5020','5021','5022','5030','5040','5050','5060','5070','5080','5090','5100','5101','5110','5120','5130','5140','5150','5160','5170','5180','5190','5200','5210'];
        
        foreach ($plants as $plant) {          
            Schema::create('da'.$plant, function (Blueprint $table) {
                $plant = substr($table->getTable(),-4);
                $table->increments('id');
                $table->integer('id_asigna')->unsigned();
                $table->integer('id_docente')->unsigned();
                $table->integer('id_ciclo')->unsigned();
                $table->boolean('activo')->default(true);
                $table->timestamps();

                $table->foreign('id_asigna')
                        ->references('id')->on('a'.$plant)
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                
                $table->foreign('id_docente')
                        ->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                
                $table->foreign('id_ciclo')
                        ->references('id')->on('ciclo')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('daXXXX');
    }
}
