<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CarClient;
use Illuminate\Http\Request;

class CarClientController extends Controller
{
    public function __construct(CarClient $clientex) {
        $this->cliente = $clientex;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //$cCliente=$this->filter($request,$this->carmodel);
        $cCliente=$this->filtrate($request,$this->cliente);
        if ($cCliente=="404"){
            return response()->json(['msg'=>'resource not found'],404);
        }

        return response()->json($cCliente, 200);
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
private function filtrate($request,$objInst){
    if ($request->has('myfilter')){
        $myfilter=base64_decode($request->myfilter);
        $vvv=explode("&&&",$myfilter);
        $objInst=$objInst->simpleSearch($vvv[0],$vvv[1]);
        if ($objInst==null){
            return "404";
        }
        return $objInst;
    } else{
    $objInst=$objInst->get();
        return $objInst;
    }    
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
        $request->validate($this->cliente->rules());

        $cCliente = $this->cliente->create([
            'name' => $request->name
        ]);

        return response()->json($cCliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($myid)
    {
        $cCliente = $this->cliente->find($myid);
        if($cCliente === null) {
            return response()->json(['error' => 'The resource does not exist'], 404) ;
        } 

        return response()->json($cCliente, 200);
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
     * @param  \App\Http\Requests\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    //=========================================
  public function update(Request $request, $myid){
        $cCliente = $this->cliente->find($myid);

        if($cCliente === null) {
            return response()->json(['error' => 'Update not performed, resource not exists'], 404);
        }

        if($request->method() === 'PATCH') {

            $dinrules = array();

            
            foreach($cCliente->rules() as $input => $rule) {
                
                if(array_key_exists($input, $request->all())) {
                    $dinrules[$input] = $rule;
                }
            }
            
            $request->validate($dinrules);

        } else {
            $request->validate($cCliente->rules());
        }
        
        $cCliente->fill($request->all());
        $cCliente->save();
        
        return response()->json($cCliente, 200);
    }
//=========================================
    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    //=========================================
    public function destroy($myid)
    {
        $cCliente = $this->cliente->find($myid);

        if($cCliente === null) {
            return response()->json(['error' => 'deletion not performed, the resource does not exists'], 404);
        }

        $cCliente->delete();
        return response()->json(['msg' => 'The client was deleted!'], 200);
    }
    //=========================================
}
