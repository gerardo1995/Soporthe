<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersXTaskTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_x_task_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_type_id')->unsigned()->index('FK_users_x_task_types_task_types_idx');
			$table->integer('user_id')->unsigned()->index('FK_users_x_task_types_users_idx');
			$table->unique(['task_type_id','user_id'], 'uk_user_task_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_x_task_types');
	}

}
