<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTableModifiedWorkshop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workshop', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('workshop_id')->nullable();
            $table->timestamps();
        });

        Schema::table('workshops', function (Blueprint $table) {              
            $table->boolean('public')->nullable()->default(false);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_workshop');

        Schema::table('workshops', function (Blueprint $table) {     
            $table->dropColumn('sharable_link');
        });
    }
}
