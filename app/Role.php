<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:41:31 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 *
 * @property \Illuminate\Database\Eloquent\Collection $departments
 *
 * @package App
 */
class Role extends Model
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

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
