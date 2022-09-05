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
            $table->string('ptj')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('school_code')->nullable();
            $table->string('institute_code')->nullable();
            $table->string('rc_code')->nullable();
            $table->string('utmfin_ref_no')->nullable();
            $table->string('bill_ref_no')->nullable();
            $table->string('receipt_ref_no')->nullable();
            $table->decimal('gross_income', 20, 2)->default(0);
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
        Schema::dropIfExists('masterlist_lab_services');
    }
}
