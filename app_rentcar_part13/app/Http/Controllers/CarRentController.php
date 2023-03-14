<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRentRequest;
use App\Http\Requests\UpdateCarRentRequest;
use App\Models\CarRent;

class CarRentController extends Controller
{
    public function __construct(CarRent $CarRent) {
        $this->carRent = $CarRent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cCarRent=$this->filter($request,$this->carRent);
        return response()->json($cCarRent, 200);
        
    }
//===================================
private function filter($request,$objInstance){
    $objInst=$objInstance;
    $objInst2=null;
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
    else {  return $objInst->all();  }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->carRent->rules());

        $cCarRent = $this->carRent->create([
            'client_id' => $request->client_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date,
            'final_date_held' => $request->final_date_held,

            'daily_rate' => $request->daily_rate,
            'km_start' => $request->km_start,
            'km_final' => $request->km_final
        ]);

        return response()->json($cCarRent, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($myid)
    {
        $cCarRent = $this->carRent->find($myid);
        if($cCarRent === null) {
            return response()->json(['error' => 'The resource does not exist'], 404) ;
        } 

        return response()->json($cCarRent, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarRent  $CarRent
     * @return \Illuminate\Http\Response
     */
    public function edit(CarRent $CarRent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarRent  $CarRent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $myid)
    {
        $cCarRent = $this->carRent->find($id);

        if($cCarRent === null) {
            return response()->json(['error' => 'Update not performed, resource not exists'], 404);
        }

        if($request->method() === 'PATCH') {

            $dinrules = array();

            //percorrendo todas as regras definidas no Model
            foreach($cCarRent->rules() as $input => $rule) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $dinrules[$input] = $rule;
                }
            }
            
            $request->validate($dinrules);

        } else {
            $request->validate($cCarRent->rules());
        }
        
        $cCarRent->fill($request->all());
        $cCarRent->save();
        
        return response()->json($cCarRent, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($myid)
    {
        $cCarRent = $this->carRent->find($myid);

        if($cCarRent === null) {
            return response()->json(['error' => 'deletion not performed, the resource does not exists'], 404);
        }

        $cCarRent->delete();
        return response()->json(['msg' => 'The Rent was deleted!'], 200);
        
    }  

}
