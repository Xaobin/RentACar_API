@extends('layouts.app_')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        <div class="card-header">Login</div>
    
        <div class="card-body">
    <!-- - - - [FORM BEGIN] - - - - - - - - - - - - - -  -->        
         <form method="POST" action="http://127.0.0.1:8000/v1/loginb" >
    <!--  - - - - - - - - - - - - - - - - - - - - - - - - - - -->                       
    <!-- [EMAIL] - - - - -  - - - - - - - - - - - - -->
        <div class="row mb-3">
            @csrf
         
            <label for="email" class="col-md-4 col-form-label text-md-right" >E-mail</label>
          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus >
          </div>                       
        
        </div>
    <!--  - - - - - - - - - - - - - - - - - - - - - - -->
    <!-- Password] - - - - - - - - - - - -  -->
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" >
            </div>
        </div>
    <!-- REMEMBER - - - - - - - - - - - - - - - - - - - - -->
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
            </div>
        </div>
    <!-- [FORGOT] - - - - - - - - - - - - - - - - - - - - - - -->
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
                <a class="btn btn-link" href="#">Forgot password</a>
            </div>
        </div>
    <!--  - - - - - - -  -->
      </form>
    <!--  - - - - - - -  -->
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
