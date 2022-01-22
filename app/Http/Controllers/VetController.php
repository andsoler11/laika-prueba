<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vet;

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
        return $vets;
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Vet::$rules);
        $vet = new Vet();
        $vet->name = $request->name;
        $vet->city = $request->city;
        $vet->phone = $request->phone;
        $vet->save();
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vet = Vet::find($id);
        return $vet;
    }


    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate(Vet::$rules);
        $vet = Vet::findOrFail($request->id);
        $vet->name = $request->name;
        $vet->city = $request->city;
        $vet->phone = $request->phone;
        $vet->save();

        return $vet;
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vet = Vet::destroy($request->id);
        return $vet;
    }
}
