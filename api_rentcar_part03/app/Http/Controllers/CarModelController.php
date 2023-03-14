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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->carmodel->with('carBrand')->get(), 200);
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
        $cModel = $this->carmodel->with('carBrand')->find($myid);
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
