<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_projects', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->text('title');
            $table->string('code');
            $table->string('code_2')->nullable();
            $table->integer('program_id')->nullable();
            $table->string('is_fixed_subproject')->default('N');
            $table->string('type')->default('single');
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
        Schema::dropIfExists('dru_projects');
    }
}
