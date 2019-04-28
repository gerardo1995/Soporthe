<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_id')->unsigned()->index('FK_task_logs_tasks_idx');
			$table->integer('task_state_id')->unsigned()->index('FK_task_logs_task_states_idx');
			$table->integer('user_id')->unsigned()->index('FK_task_logs_users');
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
		Schema::drop('task_logs');
	}

}
