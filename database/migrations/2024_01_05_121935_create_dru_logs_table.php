<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDruLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dru_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('approval_app_id');
            $table->longText('data');
            $table->string('targeted_data')->nullable();
            $table->string('type');
            $table->string('category')->nullable();
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
        Schema::dropIfExists('dru_logs');
    }
}
