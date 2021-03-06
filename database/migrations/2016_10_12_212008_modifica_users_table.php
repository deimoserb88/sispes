<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login',5)->after('email')->unique();//numero de trabajador XXXXX
            $table->string('rol',5)->nullable()->after('name');
            $table->string('plant',20)->nullable()->after('rol');//Desaparece, se reemplaza por las dos siguientes en modifica2_users_table
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
