<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller{
    //= = = = = = = = = = = = = = = 
    public function __construct(){
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }
    //= = = = = = = = = = = = = = = 
    public function login(Request $request){
        $credentials = $request->all(['email', 'password']); //[]

        //autenticação (email e senha)
        //$this->doAuth($request->email,$request->password);
       
        $token = auth('api')->attempt($credentials);
        $checks=md5($token);
        $token=$token.".".$checks;
        $name=base64_encode($this->getname());
        $token=$token.".".$name;
        //Auth::attempt($credentials);
        if($token) { //usuário autenticado com sucesso
            return response()->json(['token' => $token]);

        } else { //erro de usuário ou senha
            return response()->json(['erro' => 'Invalid user or password!'], 403);

            //401 = Unauthorized -> não autorizado
            //403 = forbidden -> proibido (login inválido)
        }

        //retornar um Json Web Token
        return 'login';
    }
    //= = = = = = = = = = = = = = = 
    public function logout(){
        auth('api')->logout();
        return response()->json(['msg' => 'Logout was successful!']);
    }
    //= = = = = = = = = = = = = = = 
    public function refresh(){
        $token = auth('api')->refresh(); //cliente encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }
    //= = = = = = = = = = = = = = = 
    public function me(){
        //dd(auth()->user());
        return response()->json(auth()->user());
       // return response()->json(mb_convert_encoding($auth->user, 'UTF-8', 'UTF-8'));
    }
    //= = = = = = = = = = = = = = = 
    private function dosess($token){
            session_start();
            $_SESSION['mytoken']=$token;
    }
    //= = = = = = = = = = = = = = = 
    private function getname(){
        return auth()->user()->name;
    }
    //= = = = = = = = = = = = = = = 
    public function onename(){
        return auth()->user()->name;
    }
    //= = = = = = = = = = = = = = = 
}
