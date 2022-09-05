<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistElnptActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_elnpt_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('application_pk')->nullable();
            $table->string('rm')->nullable();
            $table->string('arm')->nullable();
            $table->string('activity_no')->nullable();
            $table->string('cost_center_code')->nullable();
            $table->string('pro_refno')->nullable();
            $table->string('grant_acronym')->nullable();
            $table->string('grant_type')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('faculty')->nullable();
            $table->string('niche_area')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('application_type')->nullable();
            $table->string('staffno_applicant')->nullable();
            $table->string('staff_applicant')->nullable();
            $table->string('student_applicant')->nullable();
            $table->string('matric_no')->nullable();
            $table->string('guest_applicant_name')->nullable();
            $table->string('ic_no')->nullable();
            $table->text('activity_name')->nullable();
            $table->string('bandar')->nullable();
            $table->string('negeri')->nullable();
            $table->string('negara')->nullable();
            $table->decimal('estimated_cost', 20, 2)->default(0);
            $table->datetime('act_start_date')->nullable();
            $table->datetime('act_end_date')->nullable();
            $table->text('paper_title')->nullable();
            $table->string('status_fk')->nullable();
            $table->string('act_app_status')->nullable();
            $table->string('submit_status')->nullable();
            $table->text('submit_remark')->nullable();
            $table->datetime('submit_date')->nullable();
            $table->string('arm_process_status')->nullable();
            $table->text('arm_remark')->nullable();
            $table->datetime('arm_date_approval')->nullable();
            $table->string('clerk_process_status')->nullable();
            $table->text('clerk_remark')->nullable();
            $table->datetime('clerk_date_approval')->nullable();
            $table->string('dd_status')->nullable();
            $table->text('dd_remark')->nullable();
            $table->datetime('dd_date_approval')->nullable();
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
        Schema::dropIfExists('masterlist_elnpt_activities');
    }
}
