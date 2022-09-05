<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistElnptGrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_elnpt_gras', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('vot_number')->nullable();
            $table->string('grant_code')->nullable();
            $table->string('rm_name')->nullable();
            $table->string('app_refno')->nullable();
            $table->string('gender')->nullable();
            $table->string('student_name')->nullable();
            $table->string('study_mode')->nullable();
            $table->string('country')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('app_type')->nullable();
            $table->datetime('app_start_date')->nullable();
            $table->datetime('app_end_date')->nullable();
            $table->string('app_status')->nullable();
            $table->string('pk')->nullable();
            $table->string('curr_employment_status')->nullable();
            $table->string('faculty')->nullable();
            $table->integer('rate_per_hour', 20, 2)->default(0);
            $table->decimal('allowance_amt', 20, 2)->default(0);
            $table->decimal('total_payment', 20, 2)->default(0);
            $table->string('project_leader_id')->nullable();
            $table->string('project_leader_name')->nullable();
            $table->string('submit_status')->nullable();
            $table->text('submit_remark')->nullable();
            $table->datetime('submit_date')->nullable();
            $table->string('ra_fc_ins_h_process_status')->nullable();
            $table->text('ra_fc_ins_h_t_remark')->nullable();
            $table->datetime('ra_fc_ins_h_date_approve')->nullable();
            $table->string('clerk_process_status')->nullable();
            $table->text('clerk_remark')->nullable();
            $table->datetime('clerk_date_approve')->nullable();
            $table->string('officer_process_status')->nullable();
            $table->text('officer_remark')->nullable();
            $table->datetime('officer_date_approve')->nullable();
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
        Schema::dropIfExists('masterlist_elnpt_gras');
    }
}
