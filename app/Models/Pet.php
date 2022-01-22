<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    static $rules = [
		'vet_id' => 'required',
		'pet_name' => 'required',
		'owner_name' => 'required',
		'animal' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['vet_id','pet_name','owner_name','animal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vet()
    {
        return $this->hasOne('App\Models\Vet', 'id', 'vet_id');
    }
    
}
