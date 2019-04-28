<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:41:58 +0000.
 */

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Department;
use Laravel\Passport\HasApiTokens;
/**
 * Class User
 *
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $email
 * @property \Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Department $department
 * @property \Illuminate\Database\Eloquent\Collection $places
 * @property \Illuminate\Database\Eloquent\Collection $task_messages
 * @property \Illuminate\Database\Eloquent\Collection $tasks
 * @property \Illuminate\Database\Eloquent\Collection $task_types
 *
 * @package App
 */
class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;
	use HasApiTokens;


	protected $fillable = [
		'department_id',
		'role_id',
		'place_id',
		'name',
		'email',
		'password',
		'phone'
	];

	protected $casts = [
		'department_id' => 'int'
	];

	protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function scopeSearch($query, $search){
    	return $query
    		->where('name','like','%'.$search.'%')
    		->orWhere('email','like','%'.$search.'%')
    		->orWhere('phone','like','%'.$search.'%')
    		->orWhereHas('department',function($q) use($search){
    			$q->where('name','like','%'.$search.'%');
    		})
    		->orWhereHas('role',function($q)use($search){
    			$q->where('name','like','%'.$search.'%');
    		})
    		->orWhereHas('place',function($q)use($search){
    			$q->where('domain','like','%'.$search.'%')
    			->where('municipality','like','%'.$search.'%')
    			->where('address','like','%'.$search.'%');
    		});
    }

	public function department()
	{
		return $this->belongsTo(\App\Department::class);
	}
	public function role()
	{
		return $this->belongsTo(\App\Role::class);
	}

	public function place()
	{
		return $this->belongsTo(\App\Place::class);
	}

	public function task_messages()
	{
		return $this->hasMany(\App\TaskMessage::class);
	}

	public function tasks()
	{
		return $this->hasMany(\App\Task::class);
	}

	public function task_types()
	{
		return $this->belongsToMany(\App\TaskType::class, 'users_x_task_types');
	}
}
