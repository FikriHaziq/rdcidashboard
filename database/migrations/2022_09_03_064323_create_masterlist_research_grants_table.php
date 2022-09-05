<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistResearchGrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_research_grants', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('project_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('name')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('school_code')->nullable();
            $table->string('institute_code')->nullable();
            $table->string('rc_code')->nullable();
            $table->string('st')->nullable();
            $table->string('status')->nullable();
            $table->text('research_title')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('duration_month')->nullable();
            $table->string('project_status')->nullable();
            $table->string('project_extension')->nullable();
            $table->datetime('extension_start_date')->nullable();
            $table->datetime('extension_end_date')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('sponsor_category')->nullable();
            $table->text('grant_name')->nullable();
            $table->decimal('amount_pledged', 20, 2)->default(0);
            $table->decimal('amount_received', 20, 2)->default(0);
            $table->decimal('amount_spent', 20, 2)->default(0);
            $table->text('remark')->nullable();
            $table->string('pi')->nullable();
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
        Schema::dropIfExists('masterlist_research_grants');
    }
}
