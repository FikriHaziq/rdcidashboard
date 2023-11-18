<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruKpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_kpis', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('distribution_plan_form_id');
            $table->integer('kpi_template_id');
            $table->integer('count');
            $table->decimal('amount', 18, 9);
            $table->decimal('total', 18, 9);
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
        Schema::dropIfExists('dru_kpis');
    }
}
