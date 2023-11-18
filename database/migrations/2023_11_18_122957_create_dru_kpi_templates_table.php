<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruKpiTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_kpi_templates', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('type');
            $table->integer('program_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('sub_project_id')->nullable();
            $table->integer('main_distribution_id')->nullable();
            $table->string('display_level')->nullable();
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
        Schema::dropIfExists('dru_kpi_templates');
    }
}
