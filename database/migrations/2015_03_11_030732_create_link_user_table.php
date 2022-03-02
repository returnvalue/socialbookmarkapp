<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('link_user', function(Blueprint $table)
		{
          $table->integer('link_id')->unsigned()->nullable();
          $table->foreign('link_id')->references('id')
                ->on('links')->onDelete('cascade');

          $table->integer('user_id')->unsigned()->nullable();
          $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

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
		
		Schema::drop('link_user');

	}

}
