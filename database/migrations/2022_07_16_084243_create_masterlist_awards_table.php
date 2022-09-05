<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_awards', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('school_code')->nullable();
            $table->string('institute_code')->nullable();
            $table->string('rc_code')->nullable();
            $table->text('award_name')->nullable();
            $table->string('award_type')->nullable();
            $table->string('conferring_body')->nullable();
            $table->string('nat_int')->nullable();
            $table->text('title')->nullable();
            $table->text('event')->nullable();
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
        Schema::dropIfExists('master_list_awards');
    }
}
