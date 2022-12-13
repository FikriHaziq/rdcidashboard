<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistOperationalExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_operational_expenditures', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->decimal('amount', 20, 2)->default(0);
            $table->decimal('percentage', 20, 2)->default(0);
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
        Schema::dropIfExists('masterlist_operational_expenditures');
    }
}
