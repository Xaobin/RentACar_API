<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRent extends Model{
    /*
    id 	client_id 	car_id 	start_date 	expected_end_date 	final_date_held 	daily_rate 	km_start 	km_final 	created_at 	updated_at 	
    */ 
    use HasFactory;
    protected $table = 'car_rents';
    protected $fillable = [
        'client_id', 
        'car_id', 
        'start_date', 
        'expected_end_date',
        'final_date_held',
        'daily_rate',
        'km_start',
        'km_final'
    ];

    public function rules() {
        return [
            'client_id' => 'exists:car_clients,id',
            'car_id' => 'exists:cars,id',
            'start_date' => 'required'
            
        ];
    }
}
