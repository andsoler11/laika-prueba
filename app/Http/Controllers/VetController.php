<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vet;

class VetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vets = Vet::all();
        return $vets;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = request()->validate(Vet::$rules);
        // print_r($validator); exit;

        $vet = new Vet();
        $vet->name = $request->name;
        $vet->city = $request->city;
        $vet->phone = $request->phone;
        $vet->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vet = Vet::find($id);
        return $vet;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vet = Vet::destroy($request->id);
        return $vet;
    }
}
