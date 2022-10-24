<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyraCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myra_calculations', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('type');
            $table->longText('benchmark_target');
            $table->longText('benchmark_mark');
            $table->longText('mark');
            $table->longText('achievement');
            $table->longText('overall');
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
        Schema::dropIfExists('myra_calculations');
    }
}
