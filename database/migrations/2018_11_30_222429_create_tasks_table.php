<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_type_id')->unsigned()->index('FK_tasks_task_types_idx');
			$table->integer('technician_id')->unsigned()->index('FK_tasks_users_idx');
			$table->integer('client_id')->unsigned()->index('FK_tasks_users_idx1');
			$table->integer('task_state_id')->unsigned()->index('FK_tasks_task_states_idx');
			$table->string('code', 20);
			$table->string('description', 9000)->nullable();
			$table->string('annotation', 7300)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasks');
	}

}
