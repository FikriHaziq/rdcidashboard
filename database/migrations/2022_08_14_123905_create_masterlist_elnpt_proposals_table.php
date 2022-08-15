<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistElnptProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_elnpt_proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('reference_no')->nullable();
            $table->text('grant_name')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('faculty')->nullable();
            $table->string('school')->nullable();
            $table->string('ra')->nullable();
            $table->text('research_title')->nullable();
            $table->text('subsponsor')->nullable();
            $table->decimal('total_sodo_item_in_proposal', $precision = 12, $scale = 2)->default(0);
            $table->string('status_proposal')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('masterlist_elnpt_proposals');
    }
}
