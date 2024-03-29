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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        //$cBrand=$this->filter($request,$this->carbrand,'refCarModels');
        $cBrand=$this->filtrate($request,$this->carbrand);
        if ($cBrand=="404"){
            return response()->json(['msg'=>'resource not found'],404);
        }
       
        if ($cBrand==null)
        { $cBrand = $this->carbrand->with('refCarModels')->get(); }
       return response()->json($cBrand,200);
       
    }
   
 
    //================================
private function filtrate($request,$objInst){
    if ($request->has('myfilter')){
        //?myfilter= base64 valor
        //base 64 decode: field&&&value
        //aWQmJiY0 is id&&&4
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
    //================================
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
        $image_urn=$image->store('images','public2');
     

        $cBrand=$this->carbrand->create(['name'=>$request->name,'image'=>$image_urn]);
      
        return response()->json($cBrand,201);
        
    }
// = = = = = = = = = = = = = = = = = = =
private function getNewName($name){
    $chars=hash("sha384",$name);
    $n=14;
    $randString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $randString .= $chars[$index];
    }
    return $randString;
}
// = = = = = = = = = = = = = = = = = = =
    /**
     * Display the specified resource. 
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function show($mynumber){
        
        //$carBrandx=CarBrand::where("id","=",$mynumber)->get();
       $carBrandx=$this->carbrand->with('refCarModels')->find($mynumber);
       if ($carBrandx===null){
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
    if($request->file('image')) {
        Storage::disk('public2')->delete($cBrand->image); 
        $image = $request->file('image');
        $image_urn = $image->store('images', 'public2');

        $cBrand->fill($request->all());
        $cBrand->image=$image_urn;
        $cBrand->name=$request->name;
        $cBrand->save();
    }
    //................
   else{
    $cBrand->fill($request->all());
    //$cBrand->image=$image_urn;
    $cBrand->save();
    }
       

      
       
      
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
