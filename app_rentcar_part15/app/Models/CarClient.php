<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CarClient extends Model
{
    use HasFactory;
    protected $table="car_clients";
    protected $fillable = ['name'];

    public function rules() {
        return [
            'name' => 'required' 
        ];
    }

    public function feedback() {
        return [
            'required' => 'The field :attribute is required'
        ];
    }
    //=========================
    public function simpleSearch($field1,$vall){
        $table1=$this->table; $opera="";
        if ($field1=='id'){ $opera="="; } else { $opera="LIKE"; $vall="%".$vall."%"; }
         $querr="select * from $table1 where $table1.$field1 $opera '$vall'"; 
        
        $dest=
            DB::select($querr);
            return $dest;
     }
     //=========================
}
