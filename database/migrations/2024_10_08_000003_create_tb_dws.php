<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_daily_ws', function (Blueprint $table) {
            $table->id('id_dws')->primary();
            $table->time('working_time_dws')->nullable();
            $table->string('descb_dws')->nullable();
            $table->time('arrival_time_dws')->nullable();
            $table->time('finish_time_dws')->nullable();
            $table->integer('progress_actual_dws')->nullable();
            $table->integer('progress_current_dws')->nullable();
            $table->foreignId('id_karyawan')->nullable()->constrained('tb_karyawan', 'id_karyawan');
            // $table->foreignId('id_project')->nullable()->constrained('tb_projects', 'id_project');
            $table->string('id_project')->nullable(); // Keep it as a string to match tb_projects
            $table->foreign('id_project')->references('id_project')->on('tb_projects')->onDelete('set null'); // Correct foreign key definition
            $table->unsignedBigInteger('id_monitoring')->nullable(); // Add this line BEFORE the foreign key constraint
            $table->foreign('id_monitoring')->references('id_monitoring')->on('tb_monitoring')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_daily_ws', function (Blueprint $table) {
            $table->dropForeign(['id_karyawan']);
            $table->dropForeign(['id_project']);
            $table->dropForeign(['id_monitoring']);

        });
        Schema::dropIfExists('tb_daily_ws');
    }
};
