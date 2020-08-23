<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mailbox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string("mail_id",255);
            $table->string("uid",255);
            $table->string('subject',255)->nullable;
            $table->string("from_email",255);
            $table->string('name',255);
            $table->string("to_email",255)->comment("Email account of user")->nullable();  // TODO : If Multiple mail accounts are users / Foreign reference users table
            $table->text("body_content");
            $table->text("original_content");
            $table->timestamp('mail_received_at');
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
        Schema::dropIfExists('mails');
    }
}
