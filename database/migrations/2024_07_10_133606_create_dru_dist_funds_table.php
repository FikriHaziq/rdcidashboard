<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruDistFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_dist_funds', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->text('title');
            $table->string('faculty_code')->nullable();
            $table->string('code');
            $table->string('code_2')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('main_fund_id')->nullable();
            $table->tinyInteger('is_draft')->default(1);
            $table->string('status')->default('active');
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
        Schema::dropIfExists('dru_dist_funds');
    }
}
