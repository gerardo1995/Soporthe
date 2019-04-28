<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:42:03 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskType
 *
 * @property int $id
 * @property string $name
 *
 * @property \Illuminate\Database\Eloquent\Collection $tasks
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App
 */
class TaskType extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function scopeSearch($query, $search){
    	return $query
    		->where('name','like','%'.$search.'%');
    }

	public function tasks()
	{
		return $this->hasMany(\App\Task::class);
	}

	public function users()
	{
		return $this->belongsToMany(\App\User::class, 'users_x_task_types');
	}
}
