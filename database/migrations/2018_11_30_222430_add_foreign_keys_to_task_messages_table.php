<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_messages', function(Blueprint $table)
		{
			$table->foreign('task_id', 'FK_task_messages_tasks')->references('id')->on('tasks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'FK_task_messages_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_messages', function(Blueprint $table)
		{
			$table->dropForeign('FK_task_messages_tasks');
			$table->dropForeign('FK_task_messages_users');
		});
	}

}
