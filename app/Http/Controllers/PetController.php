<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Vet;
use DB;

/**
 * in this controller I'm going to use the SP to get the calls to the db
 */
class PetController extends Controller
{
    /**
     * call the SP of select all pets and returns all
     * existing pets
     * also return all existing vets so we can use the vet_id
     * to get the vet_name for the frontend
     */
    public function index()
    {
        $pets = DB::select("call select_all_pets()");
        $vets = Vet::all();
        return [$pets, $vets];
    }

    /**
     * store the pet with the inputs passed,
     * first validate that all the required inputs are passed
     * then call the SP to create the pet
     */
    public function store(Request $request)
    {
        $request->validate(Pet::$rules);
        $dateNow = date('Y-m-d H:i:s');
        DB::select("call create_pet(?,?,?,?,?,?)",
                    [
                    $request->input('vet_id'), 
                    $request->input('pet_name'), 
                    $request->input('owner_name'), 
                    $request->input('animal'), 
                    $dateNow,
                    $dateNow
                    ]);
    }


    /**
     * here we get the SP to select a pet by the id
     * return the pet and also all vets so we can handle relations in front
     */
    public function show($id)
    {
        $pet = DB::select("call select_pet_by_id(?)", [$id])[0];
        $vets = Vet::all();
        return [$pet, $vets];
    }

    /**
     * get the pet that we want to edit, call the SP
     * to get the pet by the id
     */
    public function edit($id)
    {
        $pet = DB::select("call select_pet_by_id(?)", [$id])[0];
        return $pet;
    }

    /**
     * update the pet passed, first we validate that the pet exists in our db
     * and also that the vet_id passed also exist in out db
     * then we call the SP of update pet and set all inputs
     * also we validate that the required inputs are passed
     */
    public function update(Request $request, $id)
    {
        request()->validate(Pet::$rules);
        $pet = Pet::findOrFail($request->id);
        $pet = Vet::findOrFail($request->vet_id);
        $dateNow = date('Y-m-d H:i:s');
        DB::select("call update_pet(?,?,?,?,?,?)",
                    [
                    $id, 
                    $request->input('vet_id'), 
                    $request->input('pet_name'), 
                    $request->input('owner_name'), 
                    $request->input('animal'), 
                    $dateNow
                    ]);

    }

    /**
     * call the SP to delete the pet by id
     * it will delete the pet passed
     */
    public function destroy($id)
    {
        $pet = DB::select("call delete_pet_by_id(?)", [$id]);
        return $pet;
    }
}
