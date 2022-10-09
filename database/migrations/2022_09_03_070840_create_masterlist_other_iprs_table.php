<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistOtherIprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_other_iprs', function (Blueprint $table) {
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
            $table->string('ip_id')->nullable();
            $table->text('ip_name')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('masterlist_other_iprs');
    }
}
