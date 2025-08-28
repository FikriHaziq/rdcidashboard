<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruDistributionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_distribution_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->decimal('amount', 18, 9);
            $table->integer('c_id');
            $table->string('status')->default('draft');
            $table->integer('parent_id')->nullable();
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
        Schema::dropIfExists('dru_distribution_plans');
    }
}
