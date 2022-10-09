<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistLabServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_lab_services', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('lab')->nullable();
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
            $table->string('utmfin_ref_no')->nullable();
            $table->string('bill_ref_no')->nullable();
            $table->string('receipt_ref_no')->nullable();
            $table->decimal('gross_income', 20, 2)->default(0);
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
        Schema::dropIfExists('masterlist_lab_services');
    }
}
