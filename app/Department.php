<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:41:38 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Role $role
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App
 */
class Department extends Model
{

	protected $fillable = [
		'name'
	];
	public function scopeSearch($query, $search){
    	return $query
    		->where('name','like','%'.$search.'%');
    }

	public function users()
	{
		return $this->hasMany(\App\User::class);
	}
}
