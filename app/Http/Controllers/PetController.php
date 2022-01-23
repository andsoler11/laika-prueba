<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Vet;
use DB;
use App\Exceptions\ApiException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Mockery\Undefined;

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
        $output['pets'] = Pet::selectAll();
        $output['vets'] = Vet::all();
        return ApiException::return_result(200, $output);
    }

    /**
     * store the pet with the inputs passed,
     * first validate that all the required inputs are passed
     * then call the SP to create the pet
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Pet::$rules);
        if ($validator->fails()) {
            return ApiException::return_error('invalid field', 422, '', $validator->messages());
        }


        try {
            $vet = Vet::findOrFail($request->vet_id);
        } catch (Exception $e) {
            return ApiException::return_error('The vet selected doesn\'t exists', 404, $e->getMessage());
        }

        $response = Pet::insertData($request);
        return ApiException::return_result(200, $response, 'Pet created successfully!');
    }


    /**
     * here we get the SP to select a pet by the id
     * return the pet and also all vets so we can handle relations in front
     */
    public function show($id)
    {
        try {
            $output['pet'] = Pet::findById($id);
        } catch (Exception $e) {
            return ApiException::return_error('The pet selected doesn\'t exists', 404);
        }

        $output['vets'] = Vet::all();
        return ApiException::return_result(200, $output);
    }

    /**
     * update the pet passed, first we validate that the pet exists in our db
     * and also that the vet_id passed also exist in out db
     * then we call the SP of update pet and set all inputs
     * also we validate that the required inputs are passed
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Pet::$rules);
        if ($validator->fails()) {
            return ApiException::return_error('invalid field', 422, '', $validator->messages());
        }

        try {
            $pet = Pet::findOrFail($request->id);
        } catch (Exception $e){
            return ApiException::return_error('The pet selected doesn\'t exists', 404);
        }

        try {
            $vet = Vet::findOrFail($request->vet_id);
        } catch (Exception $e){
            return ApiException::return_error('The vet selected doesn\'t exists', 404);
        }
        

        $response = Pet::updateData($request, $id);
        return ApiException::return_result(200, $response, 'Updated pet sucessfully!');
    }

    /**
     * call the SP to delete the pet by id
     * it will delete the pet passed
     */
    public function destroy($id)
    {
        $pet = Pet::deleteById($id);
        return ApiException::return_result(200, $pet, 'Deleted pet sucessfully!');
    }
}
