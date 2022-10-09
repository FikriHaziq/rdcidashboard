<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterlistPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterlist_publications', function (Blueprint $table) {
            $table->id();
            $table->string('publication_type')->nullable();
            $table->integer('ml_start_year')->nullable();
            $table->integer('ml_end_year')->nullable();
            $table->string('document_id')->nullable();
            $table->string('staff_id')->nullable();
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
            $table->string('staff_name')->nullable();
            $table->text('co_author_staff_id')->nullable();
            $table->text('authors')->nullable();
            $table->string('industrial')->nullable();
            $table->string('international')->nullable();
            $table->string('national')->nullable();
            $table->text('document_title')->nullable();
            $table->text('source_title')->nullable();
            $table->string('document_type_scopus')->nullable();
            $table->string('document_type')->nullable();
            $table->string('volume')->nullable();
            $table->string('issue')->nullable();
            $table->integer('citation_y1')->nullable();
            $table->integer('citation_y2')->nullable();
            $table->integer('citation_y3')->nullable();
            $table->integer('citation_y4')->nullable();
            $table->integer('citation_y5')->nullable();
            $table->integer('citation_total')->nullable();
            $table->string('page_start')->nullable();
            $table->string('page_end')->nullable();
            $table->string('book_editor')->nullable();
            $table->string('book_status')->nullable();
            $table->string('publisher')->nullable();
            $table->string('stakeholder')->nullable();
            $table->string('level')->nullable();
            $table->integer('year')->nullable();
            $table->string('issn')->nullable();
            $table->string('quartile')->nullable();
            $table->text('quartile_link')->nullable();
            $table->text('remark')->nullable();
            $table->text('remark_scopus')->nullable();
            $table->text('remark_wos')->nullable();
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
        Schema::dropIfExists('masterlist_publications');
    }
}
