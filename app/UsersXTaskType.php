<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:41:44 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersXTaskType
 *
 * @property int $task_type_id
 * @property int $user_id
 *
 * @property \App\TaskType $task_type
 * @property \App\User $user
 *
 * @package App
 */
class UsersXTaskType extends Model
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'task_type_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'task_type_id',
		'user_id',
	];

	public function task_type()
	{
		return $this->belongsTo(\App\TaskType::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}
}
