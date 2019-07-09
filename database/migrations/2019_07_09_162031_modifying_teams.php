<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyingTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('teams', function (Blueprint $table) {            
            $table->unsignedInteger('leader_id')->nullable();          
            $table->string('name')->nullable();          
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {     
            $table->dropColumn('leader_id');
            $table->dropColumn('name');
        });
    }
}
