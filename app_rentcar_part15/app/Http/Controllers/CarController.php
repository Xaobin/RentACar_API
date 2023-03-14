<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;

class CarController extends Controller{
    public function __construct(Car $carx) {
        $this->car = $carx;
    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $cCar=$this->filter($request,$this->car,'carModel');
        return response()->json($cCar, 200);
    }
 //===================================
 private function filter($request,$objInstance,$ref_method){
    $objInst=$objInstance;
    $objInst2=null;
//................    
    if($request->has('fields_model')) {
        $fields_model = $request->fields_model;
        $objInst =$objInst->with($ref_method.':id,'.$fields_model);      
    }  else { $objInst = $objInst->with($ref_method); }
//................
    if($request->has('filter')) {
        $filters = explode(';', $request->filter);
        foreach($filters as $key => $condition) {
            $c = explode(':', $condition);
            $objInst = $objInst->where($c[0], $c[1], $c[2]);
        }
    }
//................
    if($request->has('fields')) {
        $fields = $request->fields;
        $objInst = $objInst->selectRaw($fields);
    } 
    else {  $objInst = $objInst->with($ref_method);  }
//................
    $objInst=$objInst->get();
    return $objInst;
}
//==================================
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
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->car->rules());

        $cCar = $this->car->create([
            'model_id' => $request->model_id,
            'plate' => $request->plate,
            'available' => $request->available,
            'km' => $request->km
        ]);

        return response()->json($cCar, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($myid)
    {
        $cCar = $this->car->with('carModel')->find($myid);
        if($cCar === null) {
            return response()->json(['error' => 'The resource does not exist'], 404) ;
        } 

        return response()->json($cCar, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $myid)
    {
        $cCar = $this->car->find($myid);

        if($cCar === null) {
            return response()->json(['error' => 'Update not performed, resource not exists'], 404);
        }

       //.............
       if($request->method() === 'PATCH') {

        $dinrules = array();

        //percorrendo todas as regras definidas no Model
        foreach($cCar->rules() as $input => $rule) {
            
            //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
            if(array_key_exists($input, $request->all())) {
                $dinrules[$input] = $rule;
            }
        }
        $request->validate($dinrules);
    } else {
        $request->validate($cCar->rules());
    }
       //.............
        
        $cCar->fill($request->all());
        $cCar->save();
        
        return response()->json($cCar, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($myid)
    {
        $cCar = $this->car->find($myid);

        if($cCar === null) {
            return response()->json(['erro' => 'deletion not performed, the resource does not exists'], 404);
        }

        $cCar->delete();
        return response()->json(['msg' => 'The car was deleted!'], 200);
    }
}
