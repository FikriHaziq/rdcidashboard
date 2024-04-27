<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruMainFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_main_funds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('year')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('apply_to_all')->default(0);
            $table->string('code');
            $table->string('name')->nullable();
            $table->tinyInteger('is_draft')->default(0);
            $table->string('status')->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dru_main_funds');
    }
}
