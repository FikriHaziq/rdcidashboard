<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_claims', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('kerani')->nullable();
            $table->string('officer')->nullable();
            $table->string('jenis_tuntutan')->nullable();
            $table->string('no_rujukan_eform')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('status')->nullable();
            $table->string('cost_center_code')->nullable();
            $table->string('rm_name')->nullable();
            $table->string('nama_kp')->nullable();
            $table->string('utmfin_refno')->nullable();
            $table->datetime('latest_pending_to_counter')->nullable();
            $table->datetime('latest_return_counter')->nullable();
            $table->datetime('latest_accepted')->nullable();
            $table->datetime('latest_return_payment_clerk')->nullable();
            $table->datetime('latest_pending_payment_clerk')->nullable();
            $table->datetime('latest_pending_ru')->nullable();
            $table->datetime('latest_check_ru')->nullable();
            $table->datetime('latest_return_ru')->nullable();
            $table->datetime('latest_verify_ru')->nullable();
            $table->datetime('latest_pending_officer')->nullable();
            $table->datetime('latest_return_officer')->nullable();
            $table->datetime('latest_kiv_officer')->nullable();
            $table->datetime('latest_pending_director')->nullable();
            $table->datetime('latest_just_approve_dir')->nullable();
            $table->datetime('latest_just_reject_dir')->nullable();
            $table->datetime('latest_just_approve_ho')->nullable();
            $table->datetime('latest_just_reject_ho')->nullable();
            $table->datetime('latest_return_appointment')->nullable();
            $table->datetime('latest_reject_appointment')->nullable();
            $table->datetime('latest_pending_appointment')->nullable();
            $table->datetime('latest_approve_appointment')->nullable();
            $table->datetime('voucher_prepared')->nullable();
            $table->datetime('voucher_approved')->nullable();
            $table->datetime('voucher_approved_ho')->nullable();
            $table->datetime('tkh_send_to_bursar')->nullable();
            $table->datetime('latest_to_payment_clerk')->nullable();
            $table->datetime('tkh_complete')->nullable();
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
        Schema::dropIfExists('masterlist_claims');
    }
}
