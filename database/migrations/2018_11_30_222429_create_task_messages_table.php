<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_id')->unsigned()->index('FK_task_messages_tasks_idx');
			$table->integer('user_id')->unsigned()->index('FK_task_messages_users_idx');
			$table->string('content', 1000);
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
		Schema::drop('task_messages');
	}

}
