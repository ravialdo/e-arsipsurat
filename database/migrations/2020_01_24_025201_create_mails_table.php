<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
		  $table->string('mail_code');
		  $table->string('mail_from');
		  $table->string('mail_to');
		  $table->string('mail_subject');
		  $table->string('description');
		  $table->string('file');
		  $table->bigInteger('mail_type_id')->unsigned();
		  $table->foreign('mail_type_id')->references('id')->on('mail_types');
		  $table->bigInteger('user_id')->unsigned();
		  $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('mails');
    }
}
