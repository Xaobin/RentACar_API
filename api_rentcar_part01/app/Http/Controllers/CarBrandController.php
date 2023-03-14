<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carbrand=CarBrand::all();
        return $carbrand;
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
        //dd($request->all());
        $carbrand=CarBrand::create($request->all());
        return $carbrand;
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($mynumber)
    {
        //dd($mynumber);
        $carBrandx=CarBrand::where("id","=",$mynumber)->get();
        //echo $carBrandx;
       // dd($carBrandx);
        //(CarBrand $carBrandx)
        //@param  \App\Models\CarBrand  $carBrandx
        return $carBrandx;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(CarBrand $carBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $carBrand)
    {
       
        $upd_values=['name'=>$request->name,'image'=>$request->image];
        CarBrand::where('id',$carBrand)->update($upd_values);
        //$carBrand->update($request->all());
        $carupd=CarBrand::where("id","=",$carBrand)->get();
        return $carupd;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy($carBrand)
    {
        //$del=CarBrand::find($carBrand)->delete();
        $del=CarBrand::where('id','=',$carBrand)->delete();
        if ($del==1)
        { return ['msg'=>'register removed with success'];}
        else
        { return ['msg'=>'Error -  no one deleted register']; }
    }
}
