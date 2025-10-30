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
            $table->integer('project_id');
            $table->decimal('amount', 18, 2);
            $table->decimal('commitment', 18, 2)->nullable();
            $table->text('output')->nullable();
            $table->text('outcome')->nullable();
            $table->text('notes')->nullable();
            $table->text('pic_justification')->nullable();
            $table->string('approved')->default('N');
            $table->string('broadcast')->default('N');
            $table->string('reference_no')->nullable();
            $table->datetime('pic_declaration_date')->nullable();
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
