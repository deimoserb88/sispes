<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarDesTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('des', function (Blueprint $table) {
            $table->string('plant',4)->unique()->after('id');
            $table->string('nomplant')->after('plant');
            $table->string('siglas',10)->after('nomplant');
            $table->string('director')->after('siglas');
            $table->string('asesorp')->after('director');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('des', function (Blueprint $table) {
            //
        });
    }
}
