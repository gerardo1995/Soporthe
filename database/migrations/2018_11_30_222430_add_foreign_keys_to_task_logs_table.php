<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_logs', function(Blueprint $table)
		{
			$table->foreign('task_state_id', 'FK_task_logs_task_states')->references('id')->on('task_states')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('task_id', 'FK_task_logs_tasks')->references('id')->on('tasks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'FK_task_logs_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_logs', function(Blueprint $table)
		{
			$table->dropForeign('FK_task_logs_task_states');
			$table->dropForeign('FK_task_logs_tasks');
			$table->dropForeign('FK_task_logs_users');
		});
	}

}
