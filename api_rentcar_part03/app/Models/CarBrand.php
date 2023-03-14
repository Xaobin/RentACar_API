<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model{
    use HasFactory;
    protected $table="car_brands";
    protected $fillable=['name','image'];



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
    public function carModels(){
            return $this->hasMany('App\Models\CarModel');
    }

    //=========

}
