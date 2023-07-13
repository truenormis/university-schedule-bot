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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('disciplineName');
            $table->string('studyTimeName');
            $table->time('studyTimeBegin');
            $table->time('studyTimeEnd');
            $table->date('scheduleDate');
            $table->string('cabinetNumber')->nullable();
            $table->string('positionName');
            $table->string('positionShortName');
            $table->string('empFullName');
            $table->string('lastName');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('subgroupName')->nullable();
            $table->text('contentNotes')->nullable();
            $table->string('studyTypeName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
