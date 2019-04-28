<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->foreign('department_id', 'FK_users_departments')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('place_id', 'FK_users_places')->references('id')->on('places')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('role_id', 'FK_users_roles')->references('id')->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('FK_users_departments');
			$table->dropForeign('FK_users_places');
			$table->dropForeign('FK_users_roles');
		});
	}

}
