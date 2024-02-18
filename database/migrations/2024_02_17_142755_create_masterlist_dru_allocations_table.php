<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistDruAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_dru_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('tabung_induk')->nullable();
            $table->string('project')->nullable();
            $table->string('sub_project')->nullable();
            $table->string('program');
            $table->string('bpki');
            $table->string('ptj');
            $table->string('ptj_code');
            $table->longText('jenis_agihan');
            $table->string('expenditure_type')->nullable();
            $table->integer('year');
            $table->text('year_desc')->nullable();
            $table->decimal('amount', 18, 2);
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
        Schema::dropIfExists('masterlist_dru_allocations');
    }
}
