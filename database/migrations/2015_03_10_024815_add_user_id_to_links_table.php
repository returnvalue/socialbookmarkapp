<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('links', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->nullable();
        	$table->foreign('user_id')
          		  ->references('id')->on('users')
          		  ->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('links', function(Blueprint $table)
		{
			$table->dropForeign('links_user_id_foreign');
			$table->dropColumn('user_id');
		});
	}

}
