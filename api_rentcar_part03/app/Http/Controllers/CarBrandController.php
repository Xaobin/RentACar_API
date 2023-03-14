<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller{
   
    public function __construct(CarBrand $carbrandx){
        $this->carbrand=$carbrandx;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $carbrandx=$this->carbrand->with('carModels')->get();
        return response()->json($carbrandx,200);
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
    public function store(Request $request){
        $request->validate($this->carbrand->rules(), $this->carbrand->feedback());
        $image=$request->file('image');
        $image_urn=$image->store('images','public');

        $cBrand=$this->carbrand->create(['name'=>$request->name,'image'=>$image_urn]);
        return response()->json($cBrand,201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function show($mynumber){
        
        //$carBrandx=CarBrand::where("id","=",$mynumber)->get();
       $carBrandx=$this->carbrand->with('carModels')->find($mynumber);
       if ($carBrandx==null){
        return response()->json(['msg'=>'resource not found'],404);
       }
        return response()->json($carBrandx,200);
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
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $myid){
       $cBrand=$this->carbrand->find($myid);

       if ($cBrand==null){
        return response()->json(['msg'=>'The required resource does not exists'],404);
       }
       if ($request->method()=="PATCH"){
            //dinamic rules, rules() is model method
            $dinrules=array();
          foreach($cBrand->rules() as $input => $rule) {
            //search a key in array   
            if(array_key_exists($input, $request->all())) 
                { $dinrules[$input] = $rule; }
          }
          $request->validate($dinrules, $cBrand->feedback());
       }
       if ($request->method()=="PUT"){
        $request->validate($cBrand->rules(), $cBrand->feedback());
       } 
       //................
       $image = $request->file('image');
       $image_urn = $imagem->store('images', 'public');

       $cBrand->update([
           'name' => $request->name,
           'image' => $image_urn
       ]);
       
      
       return response()->json($cBrand, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($myid)
    {
        //$del=CarBrand::find($carBrand)->delete();
        $cBrand = $this->carbrand->find($myid);

        if($cBrand === null) {
            return response()->json(['error' => ' no one deleted register'], 404);
        }
        Storage::disk('public')->delete($cBrand->image);
        $cBrand->delete();
        return response()->json(['msg' => 'register removed with success'], 200);

    }
}
