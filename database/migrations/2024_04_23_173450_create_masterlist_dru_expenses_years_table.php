<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistDruExpensesYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_dru_expenses_years', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->decimal('total', 18, 2)->default(0);
            $table->tinyInteger('amount_status')->default(0);
            $table->tinyInteger('project_status')->default(0);
            $table->tinyInteger('main_fund_status')->default(0);
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
        Schema::dropIfExists('masterlist_dru_expenses_years');
    }
}
