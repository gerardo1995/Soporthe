<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->foreign('task_state_id', 'FK_tasks_task_states')->references('id')->on('task_states')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('task_type_id', 'FK_tasks_task_types')->references('id')->on('task_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('client_id', 'FK_tasks_users_client')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('technician_id', 'FK_tasks_users_technician')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tasks', function(Blueprint $table)
		{
			$table->dropForeign('FK_tasks_task_states');
			$table->dropForeign('FK_tasks_task_types');
			$table->dropForeign('FK_tasks_users_client');
			$table->dropForeign('FK_tasks_users_technician');
		});
	}

}
