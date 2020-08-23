<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actvities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("action_id");
            $table->enum('activity_type',['USER','SYSTEM']);
            $table->text("activity");
            $table->integer("user_id")->unsigned()->nullable()->commment("Refers to users table, to obtain the user info");
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('activities');

    }
}
