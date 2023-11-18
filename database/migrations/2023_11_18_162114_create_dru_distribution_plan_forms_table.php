<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruDistributionPlanFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_distribution_plan_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('c_id');
            $table->integer('distribution_plan_id');
            $table->integer('mrun');
            $table->integer('bpki');
            $table->integer('ptj_id');
            $table->integer('sub_project_id');
            $table->decimal('amount', 18, 9);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('dru_distribution_plan_forms');
    }
}
