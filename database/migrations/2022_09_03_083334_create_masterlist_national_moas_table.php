<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistNationalMoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_national_moas', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('organisation')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('school_code')->nullable();
            $table->string('institute_code')->nullable();
            $table->string('rc_code')->nullable();
            $table->text('title')->nullable();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->decimal('amount', 20, 2)->default(0);
            $table->datetime('start_date')->nullable();
            $table->datetime('expiry_date')->nullable();
            $table->string('period')->nullable();
            $table->text('agreement_link')->nullable();
            $table->text('activity_link')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('masterlist_national_moas');
    }
}
