<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname', 100);
            $table->string('patronymic', 100);
            $table->string('gender', 50);
            $table->string('occupation', 50);
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
            $table->dropColumn('surname');
            $table->dropColumn('patronymic');
            $table->dropColumn('gender');
            $table->dropColumn('occupation');
        });
    }
}
