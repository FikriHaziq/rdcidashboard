<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistAcademicStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_academic_staff', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('name')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('faculty_short')->nullable();
            $table->string('faculty_long')->nullable();
            $table->string('school_code')->nullable();
            $table->string('school_short')->nullable();
            $table->string('school_long')->nullable();
            $table->string('research_group')->nullable();
            $table->string('institute_short')->nullable();
            $table->string('institute_long')->nullable();
            $table->string('rc_short')->nullable();
            $table->string('rc_long')->nullable();
            $table->string('position')->nullable();
            $table->string('grade')->nullable();
            $table->datetime('first_appointment_date')->nullable();
            $table->datetime('current_position_appointment_date')->nullable();
            $table->datetime('service_end_date')->nullable();
            $table->datetime('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('cohort')->nullable();
            $table->string('acad_qualification')->nullable();
            $table->text('professional_qualification_1')->nullable();
            $table->text('professional_qualification_2')->nullable();
            $table->text('reg_number')->nullable();
            $table->string('st')->nullable();
            $table->string('status1')->nullable();
            $table->string('status2')->nullable();
            $table->string('status3')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('masterlist_academic_staff');
    }
}
