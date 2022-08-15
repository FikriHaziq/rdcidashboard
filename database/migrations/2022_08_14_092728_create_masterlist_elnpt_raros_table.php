<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistElnptRarosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_elnpt_raros', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('pusat_kos')->nullable();
            $table->string('center_code')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('lantikan_refno')->nullable();
            $table->string('status_permohonan')->nullable();
            $table->string('staff_lantikan')->nullable();
            $table->string('kod_jawatan')->nullable();
            $table->datetime('tkh_mula_kuatkuasa')->nullable();
            $table->datetime('tkh_tamat_kuatkuasa')->nullable();
            $table->decimal('gaji_pokok')->default(0);
            $table->string('submit_status')->nullable();
            $table->text('submit_remark')->nullable();
            $table->datetime('submit_date')->nullable();
            $table->string('clerk_process_status')->nullable();
            $table->text('clerk_remark')->nullable();
            $table->datetime('clerk_date_approve')->nullable();
            $table->string('office_process_status')->nullable();
            $table->text('office_remark')->nullable();
            $table->datetime('office_date_approve')->nullable();
            $table->string('nationality')->nullable();
            $table->string('rm')->nullable();
            $table->string('kerani')->nullable();
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
        Schema::dropIfExists('masterlist_elnpt_raros');
    }
}
