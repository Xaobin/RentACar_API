<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRentRequest;
use App\Http\Requests\UpdateCarRentRequest;
use App\Models\CarRent;

class CarRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCarRentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarRent  $carRent
     * @return \Illuminate\Http\Response
     */
    public function show(CarRent $carRent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarRent  $carRent
     * @return \Illuminate\Http\Response
     */
    public function edit(CarRent $carRent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRentRequest  $request
     * @param  \App\Models\CarRent  $carRent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRentRequest $request, CarRent $carRent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarRent  $carRent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarRent $carRent)
    {
        //
    }
}
