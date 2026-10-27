<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToMasterlistDruExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masterlist_dru_expenses', function (Blueprint $table) {
            $table->index(['year', 'month']);
            $table->index('tabung_induk');
            $table->index('ptj');
            $table->index(['project', 'sub_project']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masterlist_dru_expenses', function (Blueprint $table) {
            $table->dropIndex(['year', 'month']);
            $table->dropIndex(['tabung_induk']);
            $table->dropIndex(['ptj']);
            $table->dropIndex(['project', 'sub_project']);
        });
    }
}
