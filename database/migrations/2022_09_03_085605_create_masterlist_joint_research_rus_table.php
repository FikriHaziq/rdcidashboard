<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistJointResearchRusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_joint_research_rus', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('project_id')->nullable();
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
            $table->string('name')->nullable();
            $table->string('st')->nullable();
            $table->string('staff_status')->nullable();
            $table->string('staff_type')->nullable();
            $table->text('research_title')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->string('project_status')->nullable();
            $table->string('project_extension')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('sponsor_category')->nullable();
            $table->text('grant_name')->nullable();
            $table->decimal('amount_pledged', 20, 2)->default(0);
            $table->decimal('amount_received', 20, 2)->default(0);
            $table->decimal('amount_spent', 20, 2)->default(0);
            $table->string('organizer_1')->nullable();
            $table->string('organizer_2')->nullable();
            $table->string('organizer_3')->nullable();
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
        Schema::dropIfExists('masterlist_joint_research_rus');
    }
}
