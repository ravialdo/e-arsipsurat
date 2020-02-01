<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->bigIncrements('id');
		  $table->bigInteger('disposition_to')->unsigned();
		  $table->foreign('disposition_to')->references('id')->on('users');
            $table->bigInteger('type_mail_disposition')->unsigned();
		  $table->foreign('type_mail_disposition')->references('id')->on('mail_types');
		  $table->string('description',255);
		  $table->string('status_disposition',20);
		  $table->string('status',20);
		  $table->bigInteger('mail_id')->unsigned();
		  $table->foreign('mail_id')->references('id')->on('mails');
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
        Schema::dropIfExists('dispositions');
    }
}
