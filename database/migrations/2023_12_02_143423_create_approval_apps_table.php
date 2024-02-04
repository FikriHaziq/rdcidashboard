<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_apps', function (Blueprint $table) {
            $table->id();
            $table->integer('index');
            $table->integer('module_id')->default(1);
            $table->integer('app_id');
            $table->text('comment')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('approval_apps');
    }
}
