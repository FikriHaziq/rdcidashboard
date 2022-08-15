<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistElnptActiveGrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_elnpt_active_grants', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('vot')->nullable();
            $table->string('project_refno')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('gelaran_rasmi')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('faculty')->nullable();
            $table->string('school')->nullable();
            $table->string('ra')->nullable();
            $table->string('st_nonst')->nullable();
            $table->datetime('service_due_date')->nullable();
            $table->string('rm_staff_no')->nullable();
            $table->string('rm_name')->nullable();
            $table->string('arm_staff_no')->nullable();
            $table->string('arm_name')->nullable();
            $table->text('research_title')->nullable();
            $table->datetime('date_generate_cc')->nullable();
            $table->datetime('submission_date')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->datetime('original_date')->nullable();
            $table->datetime('new_end_date_request')->nullable();
            $table->datetime('new_end_date_approved')->nullable();
            $table->integer('year_duration')->nullable();
            $table->string('project_status')->nullable();
            $table->string('proposal_status')->nullable();
            $table->string('grant_acronym')->nullable();
            $table->string('grant_type')->nullable();
            $table->text('collaboration_name')->nullable();
            $table->string('sponsor_category')->nullable();
            $table->string('subsponsor')->nullable();
            $table->string('sdg')->nullable();
            $table->string('nkea')->nullable();
            $table->string('npa')->nullable();
            $table->string('research_area')->nullable();
            $table->string('research_class_1')->nullable();
            $table->string('commercialisation')->nullable();
            $table->decimal('amount_approved', $precision = 12, $scale = 2)->default(0);
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
        Schema::dropIfExists('masterlist_elnpt_active_grants');
    }
}
