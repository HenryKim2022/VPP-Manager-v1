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

	    // id_monitoring (PK), task, start_date, end_date, achieve_date, qty, id_karyawan (FK), id_project (FK)
        Schema::create('tb_monitoring', function (Blueprint $table) {
            $table->id('id_monitoring')->primary();
            $table->string('task')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('achieve_date')->nullable();
            $table->integer('qty')->nullable();
            $table->foreignId('id_karyawan')->nullable()->constrained('tb_karyawan', 'id_karyawan');
            $table->string('id_project')->nullable(); // Keep it as a string to match tb_projects
            $table->foreign('id_project')->references('id_project')->on('tb_projects')->onDelete('set null'); // Correct foreign key definition
            $table->timestamps();
            $table->softDeletes();
        });
        // $table->foreign('id_monitoring_parent')->references('id_monitoring')->on('tb_monitoring')->onDelete('cascade');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_projects', function (Blueprint $table) {
            $table->dropForeign(['id_karyawan']);
            // $table->dropForeign(['id_monitoring_parent']);
            // $table->dropColumn('id_monitoring_parent');
        });
        Schema::dropIfExists('tb_monitoring');
    }
};
