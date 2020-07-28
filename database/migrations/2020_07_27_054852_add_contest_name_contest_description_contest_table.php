<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContestNameContestDescriptionContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_contests', function (Blueprint $table) {
            $table->string('contest_name');
            $table->text('contest_desc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('al_contests', function (Blueprint $table) {
            $table->dropColumn('contest_name');
            $table->dropColumn('contest_desc');
        });
    }
}
