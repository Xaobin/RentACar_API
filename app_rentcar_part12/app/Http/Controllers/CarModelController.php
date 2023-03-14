<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller{
    public function __construct(CarModel $carmodelx) {
        $this->carmodel = $carmodelx;
    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $cModel=$this->filter($request,$this->carmodel,'refCarBrand');
        return response()->json($cModel, 200);
    }

 //===================================
     private function filter($request,$objInstance,$ref_method){
        $objInst=$objInstance;
        $objInst2=null;
    //................    
        if($request->has('fields_brand')) {
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
     //================================
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
        $request->validate($this->carmodel->rules());

        $image = $request->file('image');
        $image_urn = $image->store('images/carmodels', 'public');

        $cModel = $this->carmodel->create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'image' => $image_urn,
            'doors' => $request->doors,
            'seats' => $request->seats,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs
        ]);

        return response()->json($cModel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($myid){
        $cModel = $this->carmodel->with('refCarBrand')->find($myid);
        if($cModel === null) {
            return response()->json(['error' => 'Resource not found'], 404) ;
        } 

        return response()->json($cModel, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CarModel $carModel)
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
        $cModel = $this->carmodel->find($myid);

        if($cModel === null) {
            return response()->json(['error' => 'Update not performed, resource not exists'], 404);
        }

        if($request->method() === 'PATCH') {

            $dinrules = array();

            //percorrendo todas as regras definidas no Model
            foreach($cModel->rules() as $input => $rule) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $dinrules[$input] = $rule;
                }
            }
            
            $request->validate($dinrules);

        } else {
            $request->validate($cModel->rules());
        }
        
        //remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        if($request->file('image')) {
            Storage::disk('public')->delete($cModel->image);
        }
        
        $image = $request->file('image');
        $image_urn = $image->store('images/carmodels', 'public');

        $cModel->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'image' => $image_urn,
            'doors' => $request->doors,
            'seats' => $request->seats,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs
        ]);

        return response()->json($cModel, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($myid){
        $cModel = $this->carmodel->find($myid);

        if($cModel === null) {
            return response()->json(['error' => 'deletion not performed, the resource does not exists'], 404);
        }

        //remove o arquivo antigo
        Storage::disk('public')->delete($cModel->image);

        $cModel->delete();
        return response()->json(['msg' => 'The car model was deleted!'], 200);
    }
}
