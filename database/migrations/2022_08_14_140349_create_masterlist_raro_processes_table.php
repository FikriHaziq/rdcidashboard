<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistRaroProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_raro_processes', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('no_rujukan')->nullable();
            $table->string('pusat_kos')->nullable();
            $table->string('lantikan_refno')->nullable();
            $table->string('status_fk')->nullable();
            $table->string('status_permohonan')->nullable();
            $table->string('no_pekerja')->nullable();
            $table->string('nama_staf_lantikan')->nullable();
            $table->string('no_ic')->nullable();
            $table->datetime('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('position_code')->nullable();
            $table->string('position')->nullable();
            $table->string('faculty')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('email_kedua')->nullable();
            $table->string('no_tel_bimbit')->nullable();
            $table->string('no_tel_bimbit_1')->nullable();
            $table->string('appointment_type')->nullable();
            $table->string('curr_employment_status')->nullable();
            $table->datetime('tkh_mula_kuatkuasa')->nullable();
            $table->datetime('tkh_tamat_kuatkuasa')->nullable();
            $table->string('peringkat_gaji')->nullable();
            $table->decimal('gaji_pokok', $precision = 12, $scale = 2)->default(0);
            $table->string('nama_kp')->nullable();
            $table->string('no_pekerja_kp')->nullable();
            $table->string('no_pekerja_rm')->nullable();
            $table->string('nama_rm')->nullable();
            $table->string('no_pekerja_arm')->nullable();
            $table->string('nama_arm')->nullable();
            $table->string('module_name')->nullable();
            $table->string('submit_by')->nullable();
            $table->string('no_pekerja_1')->nullable();
            $table->string('nama_penilai')->nullable();
            $table->string('status_penilaian')->nullable();
            $table->text('remark')->nullable();
            $table->datetime('tkh_submit')->nullable();
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
        Schema::dropIfExists('masterlist_raro_processes');
    }
}
