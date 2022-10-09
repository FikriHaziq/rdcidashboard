<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_gifts', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('faculty')->nullable();
            $table->text('gift')->nullable();
            $table->string('faculty_code')->nullable();
            $table->string('faculty_short')->nullable();
            $table->string('faculty_long')->nullable();
            $table->string('school_code')->nullable();
            $table->string('school_short')->nullable();
            $table->string('school_long')->nullable();
            $table->string('research_group')->nullable();
            $table->string('institute_short')->nullable();
            $table->string('institute_long')->nullable();
            $table->string('rc_short')->nullable();
            $table->string('rc_long')->nullable();
            $table->string('donor')->nullable();
            $table->string('type')->nullable();
            $table->datetime('date_received')->nullable();
            $table->decimal('value', 20, 2)->default(0);
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
        Schema::dropIfExists('masterlist_gifts');
    }
}
