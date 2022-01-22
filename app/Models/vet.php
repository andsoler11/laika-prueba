<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vet extends Model
{ 
    static $rules = [
		'name' => 'required',
		'city' => 'required',
		'phone' => ['required', 'digits:10'],
    ];
    

    protected $fillable = ['name', 'city', 'phone'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'vet_id', 'id');
    }
}
