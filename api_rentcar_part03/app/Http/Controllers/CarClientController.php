<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarClientRequest;
use App\Http\Requests\UpdateCarClientRequest;
use App\Models\CarClient;

class CarClientController extends Controller
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
     * @param  \App\Http\Requests\StoreCarClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarClientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarClient  $carClient
     * @return \Illuminate\Http\Response
     */
    public function show(CarClient $carClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarClient  $carClient
     * @return \Illuminate\Http\Response
     */
    public function edit(CarClient $carClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarClientRequest  $request
     * @param  \App\Models\CarClient  $carClient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarClientRequest $request, CarClient $carClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarClient  $carClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarClient $carClient)
    {
        //
    }
}
