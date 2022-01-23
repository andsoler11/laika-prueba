<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vet;
use App\Exceptions\ApiException;
use Exception;
use Illuminate\Support\Facades\Validator;
/**
 * in this cotroller I'm going to use the ORM to do the calls to the DB
 */
class VetController extends Controller
{
    /**
     * return all vets that are in our DB
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vets = Vet::all();
        return ApiException::return_result(200, $vets);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Vet::$rules);

        if ($validator->fails()) {
            return ApiException::return_error('invalid field', 422, '', $validator->messages());
        }

        $vet = new Vet();
        $vet->name = $request->name;
        $vet->city = $request->city;
        $vet->phone = $request->phone;
        $vet->save();

		return ApiException::return_result(200, $vet, 'Vet created successfully!');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vet = Vet::find($id);
        return ApiException::return_result(200, $vet, 'Found vet sucessfully!');
    }


    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), Vet::$rules);
        if ($validator->fails()) {
            return ApiException::return_error('invalid field', 422, '', $validator->messages());
        }

        try {
            $vet = Vet::findOrFail($request->id);
        } catch (\Exception $e) {
            return ApiException::return_error('The vet selected doesn\'t exists', 404, $e->getMessage());
        }

        $vet->name = $request->name;
        $vet->city = $request->city;
        $vet->phone = $request->phone;
        $vet->save();

        return ApiException::return_result(200, $vet, 'Updated vet sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vet = Vet::destroy($request->id);
        return ApiException::return_result(200, $vet, 'Deleted vet sucessfully!');
    }
}
