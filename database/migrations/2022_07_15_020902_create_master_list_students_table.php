<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterListStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_list_students', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('matric_no')->nullable();
            $table->string('ic_no')->nullable();
            $table->string('name')->nullable();
            $table->string('bachelor_cgpa_act')->nullable();
            $table->string('bachelor_cgpa_eq')->nullable();
            $table->string('cgpa_status')->nullable();
            $table->string('bachelor_uni')->nullable();
            $table->string('master_uni')->nullable();
            $table->string('degree_registered_for')->nullable();
            $table->string('study_type')->nullable();
            $table->string('study_mode')->nullable();
            $table->string('mixed_mode_ratio')->nullable();
            $table->string('st')->nullable();
            $table->string('faculty')->nullable();
            $table->string('study_area')->nullable();
            $table->string('sponsorship')->nullable();
            $table->string('sponsorship_status')->nullable();
            $table->string('school')->nullable();
            $table->integer('year_enrolled')->nullable();
            $table->integer('acedemic_year')->nullable();
            $table->integer('sem_no')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('country')->nullable();
            $table->datetime('entry_date')->nullable();
            $table->datetime('senate_approval_date')->nullable();
            $table->integer('study_duration')->nullable();
            $table->string('got')->nullable();
            $table->string('status')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_list_students');
    }
}
