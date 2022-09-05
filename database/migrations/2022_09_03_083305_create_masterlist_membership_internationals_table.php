<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistMembershipInternationalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_membership_internationals', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('name')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('school_code')->nullable();
            $table->string('institute_code')->nullable();
            $table->string('rc_code')->nullable();
            $table->string('faculty')->nullable();
            $table->string('type')->nullable();
            $table->string('staff_type')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
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
        Schema::dropIfExists('masterlist_membership_internationals');
    }
}
