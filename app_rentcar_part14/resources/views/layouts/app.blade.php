@php
    if (!isset($valid_jwt)){$valid_jwt="0";}
    else{ $valid_jwt=base64_decode($valid_jwt); }
    $name='USER';
    if (isset($_COOKIE['name'])){
    if ($_COOKIE['name']!=''){
        $name=base64_decode($_COOKIE['name']);
    }}
@endphp

    <script>
   
    function existcookie(){
        if (getCookie('token')) 
          { console.log("false"); }
        else { console.log("true"); }
        if (window.location.port>99){
            console.log(window.location.hostname+":"+window.location.port);
        }else {
         console.log(window.location.hostname);
        }
    }

    function getCookie(name) { 
        var cookies = '; ' + document.cookie; 
        var splitCookie = cookies.split('; ' + name + '='); 
        if (splitCookie.lenght == 2) return splitCookie.pop();
}
    
   
    function myredirect(){
        window.location = '/login';
    }
    function myLogout(){
       document.cookie="token=; path=/;";
       document.cookie="checks=; path=/;";
       document.cookie="name=; path=/;";
       document.cookie="wheel=; path=/;";
        sessionStorage.clear();
        myredirect();
    }
</script>
<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token - - - - - - - - - - - - -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts - - - - - - - - - - - - - - -->
    <script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts - - - - - - - - - - - - - - - -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles - - - - - - - - - - - - - - -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ymodal.css') }}" rel="stylesheet">


</head>
<body onload="existcookie()">
 
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <!-- Left Side Of Navbar -->
 <!-- [MENU] - - - - - - - - - - - - - - - - - - - - - - - - - - - -->                    
      <ul class="navbar-nav mr-auto">
  @if($valid_jwt=="TRUE")
        <li class="nav-item">
        <a class="nav-link" href="#">Clients</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="#">Rents</a>
        </li>

 <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>  Vehicles                        
        </a>

        <div class="dropdown-menu dropdown" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="">Cars</a>
	 <a class="dropdown-item" href={{route('brands')}} >Brands</a>
 	<a class="dropdown-item" href="" >Models</a>
        </div>
</li>
  @endif
        </ul>
<!-- [...] - - - - - - - - - - - - - - - - - - - - - - - - ---> 
<!-- Right Side Of Navbar -->
<!-- [MENU 2] - - - - - - - - - - - - - - - - - - - - - - - ---> 
    <ul class="navbar-nav ms-auto">
<!-- Authentication Links -->
    @if($valid_jwt!="TRUE")
       @if (Route::has('login'))
        <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}..</a>
        </li>
      @endif

      @if (Route::has('register'))
       <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
      @endif
    @endif
    @if ($valid_jwt=="TRUE")
        
       <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> @php echo $name; @endphp                         
        </a>
         <a class="dropdown-item" onclick="myLogout()">
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        Logout</a>

       

        <form id="logout-form" action="" method="POST" class="d-none">
                @csrf
        </form>
        </div>
        </li>
    @endif
 <!-- [...] - - - - - - - - - - - - - - - - - - - - - - - - --->                          
    </ul>
    </div>
    </div>
    </nav>
    <div id="app">
    <main class="py-4">
            @yield('content')
    </main>
    </div>

</body>
</html>
