<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vet extends Model
{ 
    // rules of the vet model
    // we need to pass a phone with 10 digits
    static $rules = [
		'name' => 'required',
		'city' => 'required',
		'phone' => ['required', 'digits:10'],
    ];
    
    /**
     * Attributes that should be mass-assignable.
     * @var array
     */
    protected $fillable = ['name', 'city', 'phone'];

    /**
     * in here the realtion is that 1 vet would have many pets assigned
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'vet_id', 'id');
    }
}
