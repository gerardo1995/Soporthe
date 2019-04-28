<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:42:10 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskState
 *
 * @property int $id
 * @property string $name
 *
 * @property \Illuminate\Database\Eloquent\Collection $tasks
 *
 * @package App
 */
class TaskState extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function tasks()
	{
		return $this->hasMany(\App\Task::class);
	}

}
