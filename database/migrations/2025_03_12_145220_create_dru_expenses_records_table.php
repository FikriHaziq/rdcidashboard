<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruExpensesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_expenses_records', function (Blueprint $table) {
            $table->id();
            $table->integer('distribution_plan_form_id');
            $table->integer('kpi_template_id');
            $table->integer('count');
            $table->decimal('amount', 18, 9);
            $table->decimal('commitment', 18, 2)->nullable();
            $table->text('pic_justification')->nullable();
            $table->decimal('total', 18, 9);
            $table->string('status')->default('active');
            $table->integer('c_id');
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
        Schema::dropIfExists('dru_expenses_records');
    }
}
