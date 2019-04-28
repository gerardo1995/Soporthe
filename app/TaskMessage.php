<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:42:15 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskMessage
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 *
 * @property \App\Task $task
 * @property \App\User $user
 *
 * @package App
 */
class TaskMessage extends Model
{

	protected $casts = [
		'task_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'task_id',
		'user_id',
		'content'
	];

	public function task()
	{
		return $this->belongsTo(\App\Task::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}
}
