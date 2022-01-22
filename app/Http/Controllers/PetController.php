<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Vet;
use DB;

class PetController extends Controller
{
    public function index()
    {
        $pets = DB::select("call select_all_pets()");
        $vets = Vet::all();

        return [$pets, $vets];
    }

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


    public function show($id)
    {
        $pet = DB::select("call select_pet_by_id(?)", [$id])[0];
        $vets = Vet::all();
        return [$pet, $vets];
    }

    public function edit($id)
    {
        $pet = DB::select("call select_pet_by_id(?)", [$id])[0];
        $vets = Vet::pluck('name', 'id');
        return $pet;
    }

    public function update(Request $request, $id)
    {
        $request->validate(Pet::$rules);
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

    public function destroy($id)
    {
        $pet = DB::select("call delete_pet_by_id(?)", [$id]);
        return $pet;
    }
}
