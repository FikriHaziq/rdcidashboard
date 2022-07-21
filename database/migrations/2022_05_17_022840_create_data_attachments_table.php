<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('filename');
            $table->string('status');
            $table->longText('value1')->nullable();
            $table->dateTime('d_ts')->nullable();
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
        Schema::dropIfExists('data_attachments');
    }
}
