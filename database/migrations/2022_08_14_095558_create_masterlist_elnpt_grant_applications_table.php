<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistElnptGrantApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_elnpt_grant_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('rm_staff_no')->nullable();
            $table->string('rm_name')->nullable();
            $table->string('status_proposal')->nullable();
            $table->string('reference_no')->nullable();
            $table->datetime('submission_date')->nullable();
            $table->string('sponsor_category')->nullable();
            $table->string('subsponsor')->nullable();
            $table->string('grant_name')->nullable();
            $table->datetime('date_generate_cc')->nullable();
            $table->datetime('date_declaration_letter')->nullable();
            $table->datetime('date_agree_letter')->nullable();
            $table->datetime('prodate_activated')->nullable();
            $table->string('submit_status')->nullable();
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
        Schema::dropIfExists('masterlist_elnpt_grant_applications');
    }
}
