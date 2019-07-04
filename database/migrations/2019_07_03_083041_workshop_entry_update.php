<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkshopEntryUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->longText('description')->nullable();
            $table->dateTime('start_date')->default(\Carbon\Carbon::now());
            $table->dateTime('end_date')->default(\Carbon\Carbon::now()->addDay());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('workshops', function (Blueprint $table) {
           $table->dropColumn('start_date');
           $table->dropColumn('end_date');
           $table->dropColumn('description');
       });
    }
}
