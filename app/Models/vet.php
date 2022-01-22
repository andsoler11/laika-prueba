<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vet extends Model
{
    use HasFactory;
    

    static $rules = [
		'name' => 'required',
		'city' => 'required',
		'phone' => ['required', 'digits:10'],
    ];
    

    protected $fillable = ['name', 'city', 'phone'];
}
