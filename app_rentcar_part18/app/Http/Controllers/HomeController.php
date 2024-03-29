<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
        //$this->middleware('jwt.check');
    }

    /**
     * Show the application dashboard.
     *
     * 
     */
    //==========================
    public function index(){
       
        return view('/home')->with('valid_jwt',$this->getValue());
    }
    //==========================
    public function brands(){
        
        return view('app.brands')->with('valid_jwt',$this->getValue());
    }
    //==========================
    public function clients(){
       
        return view('app.clients')->with('valid_jwt',$this->getValue());
    }
    //===========================
     public function carmodels(){
         
         return view('app.carmodels')->with('valid_jwt',$this->getValue());
     }
     //===========================
     public function cars(){
         
        return view('app.cars')->with('valid_jwt',$this->getValue());
    }
//==========================
    private function getValue(){
        $is_valid='FALSE';

        if (isset($_COOKIE['token'])){
            $token=$_COOKIE['token'];
            $checks=$_COOKIE['checks'];
            $is_valid = $this->jwt_valid($token.".".$checks);
            return base64_encode($is_valid);
        }
  
          if ($is_valid=="FALSE"){
           return base64_encode($is_valid);            
          } 
    }
    //==========================
    private function printVar($val){
        echo "<br> >> ".$val." <br>";
    }
    //==========================
    private function is_jwt_valid($jwt, $secret = 'secret') {
        // split the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];
    
        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
        $expiration = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;
    
        // build a signature based on the header and payload using the secret
        $base64_url_header = $this->base64url_encode($header);
        $base64_url_payload = $this->base64url_encode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = $this->base64url_encode($signature);
    
        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);
        
        if ($is_token_expired || !$is_signature_valid) {
            return "FALSE";
        } else {
            return "TRUE";
        }
    }
    //==========================
    private function base64url_encode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    //===========================
   
    //===========================
    private function jwt_valid($jwt){
        if ($jwt==NULL){ return "FALSE"; }
        if ($jwt==""){ return "FALSE"; }
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature = $tokenParts[2];
        $joins=$tokenParts[0].".".$tokenParts[1].".".$tokenParts[2];
        $postsign=$tokenParts[3];
        $ck=0;
        
        if ((substr_count($header,"JWT")>0) and (substr_count($header,"256")>0) ){
            $ck+=2;
        }
        if ((substr_count($payload,"login")>0) and (substr_count($payload,"prv")>0) and
        (substr_count($payload,"jti")>0) ){
            $ck+=3;
        }
        if (strlen($signature)>=10){
            $ck++;
        }
        if ($postsign==md5($joins)){
            $ck++;
        }
        if ($ck==7){ return "TRUE"; } else { return "FALSE"; }
    }
    //===========================

}
