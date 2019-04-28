<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersXTaskTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_x_task_types', function(Blueprint $table)
		{
			$table->foreign('task_type_id', 'FK_users_x_task_types_task_types')->references('id')->on('task_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'FK_users_x_task_types_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_x_task_types', function(Blueprint $table)
		{
			$table->dropForeign('FK_users_x_task_types_task_types');
			$table->dropForeign('FK_users_x_task_types_users');
		});
	}

}
