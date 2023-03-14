<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CarBrand extends Model{
    use HasFactory;
    protected $table="car_brands";
    protected $fillable=['name','image'];
    //protected $primaryKey="id";



    public function rules() {
        return [
            'name' => 'required|unique:car_brands,name,'.$this->id.'|min:3',
            'image' => 'required'
        ];

        /*
            1) tabela
            2) nome da coluna que será pesquisada na tabela3
            3) id do registro que será desconsiderado na pesquisa
        */
    }

    public function feedback() {
        return [
            'required' => 'The field :attribute is required',
            'name.unique' => 'The name already exists',
            'name.min' => 'The name must have three characters or more'
        ];
    }
    //=========
    public function refCarModels(){
            return $this->hasMany('App\Models\CarModel','brand_id','id');
    }
    //=========
 
    //=========
    //for tests
    public function alternativeRef($fields_1,$fields_2,$table_1,$table_2,$id1,$id2){
        $dest=""; $cons="";
        if ($fields_1!=""){
         $fields_1=str_replace(",",",".$table_1.".",$fields_1);
         $fields_1=$table_1.".".$fields_1;
         $fields_1=str_replace($table_1.".name",$table_1.".name as Name",$fields_1);
         $fields_1=str_replace($table_1.".image",$table_1.".image as Image",$fields_1);
        }
        if ($fields_2!=""){
         $fields_2=str_replace(",",",".$table_2.".",$fields_2);
         $fields_2=$table_2.".".$fields_2;
        }
        if (($fields_1=="")and($fields_2=="")){ $fields_1="*"; }
        if ( ($fields_1!="") and ($fields_2!="") ) { $fields_2=",".$fields_2; }
        $cons="select $fields_1 $fields_2 from $table_1,$table_2 where $table_1.$id1=$table_2.$id2";
        $dest=
        DB::select($cons);
        return $dest;
    }
    //=========
    //for tests
public function alternativeRef2(){
    $cons="select car_brands.name as Brand, car_brands.image as Image, car_models.name as Model, car_models.seats from car_brands RIGHT JOIN car_models ON (car_brands.id=car_models.brand_id)";
    $dest=
    DB::select($cons);
    return $dest;
}
    //=========

}
