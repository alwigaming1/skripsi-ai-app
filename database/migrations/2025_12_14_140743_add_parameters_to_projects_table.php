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
    Schema::table('projects', function (Blueprint $table) {
        $table->string('prodi')->nullable()->after('judul');
        $table->string('metode_penelitian')->nullable()->after('prodi');
        $table->text('variabel_penelitian')->nullable()->after('metode_penelitian');
        $table->string('sumber_data')->nullable()->after('variabel_penelitian');
    });
}

public function down()
{
    Schema::table('projects', function (Blueprint $table) {
        $table->dropColumn(['prodi', 'metode_penelitian', 'variabel_penelitian', 'sumber_data']);
    });
}
};
