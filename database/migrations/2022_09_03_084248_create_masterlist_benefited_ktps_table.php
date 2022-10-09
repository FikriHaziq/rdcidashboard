<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistBenefitedKtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_benefited_ktps', function (Blueprint $table) {
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
            $table->string('industry')->nullable();
            $table->string('project_id')->nullable();
            $table->text('project_name')->nullable();
            $table->text('project_description')->nullable();
            $table->string('star_rating')->nullable();
            $table->string('organizer')->nullable();
            $table->decimal('sponsorship_value', 20, 2)->default(0);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
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
        Schema::dropIfExists('masterlist_benefited_ktps');
    }
}
