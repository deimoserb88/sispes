<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoodifyAXXXXTable extends Migration
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
            Schema::table('a'.$plant, function (Blueprint $table) {
                //$plant = substr($table->getTable(),-4);
                //$table->dropForeign('a'.$plant.'_id_ciclo_foreign');
                $table->dropColumn('id_ciclo');
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
        Schema::table('aXXXX', function (Blueprint $table) {
            //
        });
    }
}
