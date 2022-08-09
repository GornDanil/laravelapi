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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('departments_id')->nullable();
            $table->foreign('departments_id')->references('id')->on('DepartmentsType');
            $table->unsignedBigInteger('workers_id')->nullable();
            $table->foreign('workers_id')->references('id')->on('workers');
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
            $table->dropForeign('departments_id');
            $table->dropColumn('departments_id');
            $table->dropForeign('workers_id');
            $table->dropColumn('workers_id');
        });
    }
};
