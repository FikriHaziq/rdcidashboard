<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistDruExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_dru_expenses', function (Blueprint $table) {
            $table->id();
            $table->longText('jenis_agihan');
            $table->string('ptj');
            $table->string('project')->nullable();
            $table->string('sub_project')->nullable();
            $table->string('sodo_long')->nullable();
            $table->string('sodo_short')->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->decimal('amount', 18, 2);
            $table->string('tabung_induk')->nullable();
            $table->string('migration')->nullable();
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
        Schema::dropIfExists('masterlist_dru_expenses');
    }
}
