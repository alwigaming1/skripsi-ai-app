<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->integer('credits')->default(3); // Default daftar dapat 3 Token Gratis
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('credits');
    });
}

};