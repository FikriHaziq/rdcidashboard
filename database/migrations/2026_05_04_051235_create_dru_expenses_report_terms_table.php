<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruExpensesReportTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_expenses_report_terms', function (Blueprint $table) {
            $table->id();
            $table->integer('distribution_plan_id');
            $table->text('label');
            $table->integer('term');
            $table->string('active')->default('Y');
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
        Schema::dropIfExists('dru_expenses_report_terms');
    }
}
