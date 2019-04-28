<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
   protected $casts = [
		'task_id' => 'int',
		'task_state_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'task_id',
		'task_state_id',
		'user_id'
	];

	public function scopeSearch($query, $search){
    	return $query
    		->whereHas('task',function($q) use($search){
    			$q->where('code','like','%'.$search.'%');
    		})
    		->orWhereHas('user',function($q) use($search){
    			$q->where('name','like','%'.$search.'%');
    		})
    		->orWhereHas('task_state',function($q) use($search){
    			$q->where('name','like','%'.$search.'%');
    		})
    		->orWhere('created_at','like','%'.$search.'%');
    }

	public function task()
	{
		return $this->belongsTo(\App\Task::class)->withTrashed();
	}

	public function task_state()
	{
		return $this->belongsTo(\App\TaskState::class);
	}
	public function user()
	{
		return $this->belongsTo(\App\User::class)->withTrashed();
	}
}
