<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 08 Nov 2018 16:40:56 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Place
 *
 * @property int $id
 * @property int $user_id
 * @property string $domain
 * @property string $municipality
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\User $user
 * @property \Illuminate\Database\Eloquent\Collection $tasks
 *
 * @package App
 */
class Place extends Model
{

	protected $fillable = [
		'domain',
		'municipality',
		'address'
	];
	public function scopeSearch($query, $search){
    	return $query
    		->where('domain','like','%'.$search.'%')
    		->orWhere('municipality','like','%'.$search.'%')
    		->orWhere('address','like','%'.$search.'%');
    }
	public function users()
	{
		return $this->hasMany(\App\User::class);
	}

}
