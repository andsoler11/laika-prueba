<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;

class Pet extends Model
{
    // rules of the Pet model
    static $rules = [
		'vet_id' => 'required',
		'pet_name' => 'required',
		'owner_name' => 'required',
		'animal' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     * @var array
     */
    protected $fillable = ['vet_id','pet_name','owner_name','animal'];


    /**
     * all pets would need to have 1 assigned vet
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vet()
    {
        return $this->hasOne('App\Models\Vet', 'id', 'vet_id');
    }
    
    /**
     * method to select all pets from the SP
     */
    public static function selectAll() 
    {
      $pets = DB::select("call select_all_pets()");
      return $pets;
    }

    /**
     * using the SP to insert the pet data
     */
    public static function insertData($request) 
    {
      $dateNow = date('Y-m-d H:i:s');
      $response = DB::select("call create_pet(?,?,?,?,?,?)",
                    [
                    $request->input('vet_id'), 
                    $request->input('pet_name'), 
                    $request->input('owner_name'), 
                    $request->input('animal'), 
                    $dateNow,
                    $dateNow
                    ]);
      return $response;
    }

    /**
     * using SP to find the pet by id
     */
    public static function findById($id) 
    {
      $pet = DB::select("call select_pet_by_id(?)", [$id])[0];
      return $pet;
    }


    /**
     * using SP to update the pet
     */  
    public static function updateData($request, $id) 
    {
      $dateNow = date('Y-m-d H:i:s');
      $response = DB::select("call update_pet(?,?,?,?,?,?)",
                    [
                    $id, 
                    $request->input('vet_id'), 
                    $request->input('pet_name'), 
                    $request->input('owner_name'), 
                    $request->input('animal'), 
                    $dateNow
                    ]);
      return $response;
    }

    /**
     * using SP to delete the pet by id
     */
    public static function deleteById($id) 
    {
      $pet = DB::select("call delete_pet_by_id(?)", [$id]);
      return $pet;
    }
}
